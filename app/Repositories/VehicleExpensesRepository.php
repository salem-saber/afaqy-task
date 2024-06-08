<?php

namespace App\Repositories;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class VehicleExpensesRepository
{

    private Builder $expenses;

    private function fuelQuery(): Builder
    {
        return DB::table('vehicles')
            ->select(
                'vehicles.id as vehicle_id',
                'vehicles.name as vehicle_name',
                'vehicles.plate_number',
                DB::raw('"fuel" as type'),
                'fuel_entries.cost as cost',
                'fuel_entries.entry_date as created_at'
            )
            ->join('fuel_entries', 'vehicles.id', '=', 'fuel_entries.vehicle_id');
    }

    private function insuranceQuery(): Builder
    {
        return DB::table('vehicles')
            ->select(
                'vehicles.id as vehicle_id',
                'vehicles.name as vehicle_name',
                'vehicles.plate_number',
                DB::raw('"insurance" as type'),
                'insurance_payments.amount as cost',
                'insurance_payments.contract_date as created_at'
            )
            ->join('insurance_payments', 'vehicles.id', '=', 'insurance_payments.vehicle_id');
    }

    private function serviceQuery(): Builder
    {
        return DB::table('vehicles')
            ->select(
                'vehicles.id as vehicle_id',
                'vehicles.name as vehicle_name',
                'vehicles.plate_number',
                DB::raw('"service" as type'),
                'services.total as cost',
                'services.created_at as created_at'
            )
            ->join('services', 'vehicles.id', '=', 'services.vehicle_id');
    }


    public function getExpenses(): static
    {
        $query = $this->fuelQuery()->unionAll($this->insuranceQuery())->unionAll($this->serviceQuery());
        $this->expenses = DB::table(DB::raw("({$query->toSql()}) as combined"))->mergeBindings($query);

        return $this;
    }

    public function applyFilters(array $filters = []): static
    {
        if (!empty($filters['search'])) {
            $this->expenses->where('vehicle_name', 'like', "%{$filters['search']}%");
        }

        if (!empty($filters['types'])) {
            $this->expenses->whereIn('type', $filters['types']);
        }

        if (!empty($filters['min_cost'])) {
            $this->expenses->where('cost', '>=', $filters['min_cost']);
        }

        if (!empty($filters['max_cost'])) {
            $this->expenses->where('cost', '<=', $filters['max_cost']);
        }

        if (!empty($filters['min_creation_date'])) {
            $this->expenses->where('created_at', '>=', $filters['min_creation_date']);
        }

        if (!empty($filters['max_creation_date'])) {
            $this->expenses->where('created_at', '<=', $filters['max_creation_date']);
        }

        return $this;
    }

    public function applySorting(array $sort = []): static
    {
        $sort_by = $sort['sort_by'] ?? 'cost';
        $sort_direction = $sort['sort_direction'] ?? 'asc';
        $this->expenses->orderBy($sort_by, $sort_direction);
        return $this;
    }

    public function applyPagination(array $pagination = []): LengthAwarePaginator
    {
        $current_page = $pagination['current_page'] ?? 1;
        $per_page = $pagination['per_page'] ?? 15;
        return $this->expenses->paginate($per_page, ['*'], 'page', $current_page);
    }

}
