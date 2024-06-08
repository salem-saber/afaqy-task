<?php

namespace Repositories;

use App\Repositories\VehicleExpensesRepository;
use Tests\TestCase;


class VehicleExpensesRepositoryTest extends TestCase
{


    public function testGetExpenses()
    {
        $vehicleExpensesRepository = new VehicleExpensesRepository();
        $expenses = $vehicleExpensesRepository->getExpenses();
        $this->assertIsObject($expenses);

    }

    public function testApplyFilters()
    {

        $vehicleExpensesRepository = new VehicleExpensesRepository();
        $expenses = $vehicleExpensesRepository->getExpenses()
            ->applyFilters([
                "search" => "Prof. Garland Lang",
                "types" => [
                    "fuel"
                ],
                "min_cost" => 0,
                "max_cost" => 10,
                "min_creation_date" => "2000-01-01",
                "max_creation_date" => "2023-01-01"
            ]);
        $this->assertIsObject($expenses);
    }

    public function testApplySorting()
    {
        $vehicleExpensesRepository = new VehicleExpensesRepository();
        $expenses = $vehicleExpensesRepository->getExpenses()
            ->applySorting([
                "sort_by" => "cost",
                "sort_direction" => "desc"
            ]);

        $this->assertIsObject($expenses);
    }

    public function testApplyPagination()
    {
        $vehicleExpensesRepository = new VehicleExpensesRepository();

        $expenses = $vehicleExpensesRepository->getExpenses()
            ->applyPagination([
                "current_page" => 1,
                "per_page" => 1
            ]);

        $this->assertIsObject($expenses);
    }


}
