<?php

namespace App\Http\Controllers;

use App\Builders\ResponseBuilder;
use App\Http\Requests\VehicleExpensesRequest;
use App\Services\VehicleExpensesService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class VehicleExpenseController extends Controller
{

    protected ResponseBuilder $responseBuilder;
    protected VehicleExpensesService $vehicleExpensesService;

    public function __construct(
        ResponseBuilder        $responseBuilder,
        VehicleExpensesService $vehicleExpensesService
    )
    {
        $this->responseBuilder = $responseBuilder;
        $this->vehicleExpensesService = $vehicleExpensesService;
    }


    public function getExpenses(VehicleExpensesRequest $request): JsonResponse
    {
        $validatedData = $request->validated();
        $paginated = $this->vehicleExpensesService->getExpenses($validatedData);

        $this->responseBuilder->setStatusCode(Response::HTTP_OK);
        $data = [
            'data' => $paginated->items(),
            'pagination' => [
                'total' => $paginated->total(),
                'per_page' => $paginated->perPage(),
                'current_page' => $paginated->currentPage(),
                'last_page' => $paginated->lastPage(),
                'from' => $paginated->firstItem(),
                'to' => $paginated->lastItem()
            ],
            'filters_applied' => $validatedData['filters'] ?? []
        ];
        $this->responseBuilder->setData($data);

        return $this->responseBuilder->getResponse();
    }


}
