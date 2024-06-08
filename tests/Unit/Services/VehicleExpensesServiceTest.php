<?php

namespace Services;

use App\Repositories\VehicleExpensesRepository;
use App\Services\VehicleExpensesService;
use Tests\TestCase;

class VehicleExpensesServiceTest extends TestCase
{

    public function testGetExpenses()
    {
        $vehicleExpensesService = new VehicleExpensesService(new VehicleExpensesRepository());

        $validatedData = [
            "filters" => [
                "search" => "Prof. Garland Lang",
                "types" => [
                    "fuel"
                ],
                "min_cost" => 0,
                "max_cost" => 10,
                "min_creation_date" => "2000-01-01",
                "max_creation_date" => "2023-01-01"
            ]
            ,
            "pagination" => [
                "current_page" => 1,
                "per_page" => 1
            ],
            "sort" => [
                "sort_by" => "cost",
                "sort_direction" => "desc"
            ]
        ];

        $expenses = $vehicleExpensesService->getExpenses($validatedData);
        $this->assertIsObject($expenses);
    }
}
