<?php

namespace App\Services;

use App\Repositories\VehicleExpensesRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VehicleExpensesService
{
    protected VehicleExpensesRepository $vehicleExpensesRepository;

    public function __construct(VehicleExpensesRepository $vehicleExpensesRepository)
    {
        $this->vehicleExpensesRepository = $vehicleExpensesRepository;
    }

    public function getExpenses(array $validatedData): LengthAwarePaginator
    {
        return $this->vehicleExpensesRepository->getExpenses()
            ->applyFilters($validatedData['filters'] ?? [])
            ->applySorting($validatedData['sort'] ?? [])
            ->applyPagination($validatedData['pagination'] ?? []);
    }
}
