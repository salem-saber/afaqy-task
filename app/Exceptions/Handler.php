<?php

namespace App\Exceptions;

use App\Builders\ResponseBuilder;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     * @return JsonResponse
     * @throws Throwable
     */
    public function render($request, Throwable $exception): JsonResponse
    {

        $apiResponse = new ResponseBuilder();

        if ($exception instanceof \Illuminate\Http\Exceptions\ThrottleRequestsException) {
            $apiResponse->setStatusCode(Response::HTTP_TOO_MANY_REQUESTS);
            $apiResponse->setErrors([$exception->getMessage()]);
            $apiResponse->setMessage(Response::$statusTexts[Response::HTTP_TOO_MANY_REQUESTS]);
            return $apiResponse->getResponse();
        }


        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            $apiResponse->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY);
            $apiResponse->setErrors($exception->errors());
            $apiResponse->setMessage(Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY]);
            return $apiResponse->getResponse();
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            $apiResponse->setStatusCode(Response::HTTP_NOT_FOUND);
            $apiResponse->setErrors([$exception->getMessage()]);
            $apiResponse->setMessage(Response::$statusTexts[Response::HTTP_NOT_FOUND]);
            return $apiResponse->getResponse();
        }


        $apiResponse->setStatusCode($exception->status ?? Response::HTTP_INTERNAL_SERVER_ERROR);
        $apiResponse->setErrors([$exception->getMessage()]);
        $apiResponse->setMessage(Response::$statusTexts[$exception->status ?? Response::HTTP_INTERNAL_SERVER_ERROR]);
        return $apiResponse->getResponse();

    }
}
