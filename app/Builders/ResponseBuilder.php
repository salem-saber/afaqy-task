<?php

namespace App\Builders;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ResponseBuilder
{
    private static mixed $data = null;
    private static ?array $errors = [];
    private static string $message = '';
    private static int $status_code = Response::HTTP_OK;


    /**
     * @return int
     */
    public static function getStatusCode(): int
    {
        return self::$status_code;
    }

    /**
     * @param int $status_code
     */
    public static function setStatusCode(int $status_code): void
    {
        self::$status_code = $status_code;
    }

    /**
     * @return null
     */
    public static function getData()
    {
        return self::$data;
    }

    /**
     * @param null $data
     */
    public static function setData($data): void
    {
        self::$data = $data;
    }

    /**
     * @return array
     */
    public static function getErrors(): array
    {
        return self::$errors;
    }

    /**
     * @param array $errors
     */
    public static function setErrors(array $errors): void
    {
        self::$errors = $errors;
    }


    /**
     * @return string
     */
    public static function getMessage(): string
    {
        return self::$message;
    }

    /**
     * @param string $message
     */
    public static function setMessage(string $message): void
    {
        self::$message = $message;
    }


    public static function getResponse(): JsonResponse
    {
        return response()->json([
            'data' => self::getData(),
            'errors' => self::getErrors(),
            'message' => self::getMessage(),
            'status_code' => self::getStatusCode()
        ], self::getStatusCode());
    }
}
