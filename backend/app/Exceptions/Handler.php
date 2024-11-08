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
            'message' => 'Validation failed',
            'errors' => $exception->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
