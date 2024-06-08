<?php

namespace Tests\Feature;

use Tests\TestCase;

class VehicleExpenseControllerTest extends TestCase
{

    public function testGetExpenses()
    {

        $response = $this->post('/api/vehicle-expenses',
            [
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
            ]);
        $response->assertStatus(200);
    }
}
