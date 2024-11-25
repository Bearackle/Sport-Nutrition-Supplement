<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use PHPUnit\Event\Code\Throwable;
use Symfony\Component\HttpFoundation\Response;
class Handler extends ExceptionHandler
{
    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return response()->json([
            'errors' => $exception->errors(),
            'status' => 422
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
