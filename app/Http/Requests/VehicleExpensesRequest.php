<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleExpensesRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "filters" => 'sometimes|array',
            "filters.search" => 'sometimes|string',
            "filters.types" => 'sometimes|array',
            "filters.types.*" => 'sometimes|in:fuel,insurance,service',
            "filters.min_cost" => 'sometimes|numeric',
            "filters.max_cost" => 'sometimes|numeric',
            "filters.min_creation_date" => 'sometimes|date',
            "filters.max_creation_date" => 'sometimes|date',
            "sort" => 'sometimes|array',
            "sort.sort_by" => 'sometimes|in:cost,creation_date',
            "sort.sort_direction" => 'sometimes|in:asc,desc',
            "pagination" => 'sometimes|array',
            "pagination.current_page" => 'sometimes|numeric',
            "pagination.per_page" => 'sometimes|numeric',
        ];
    }

}
