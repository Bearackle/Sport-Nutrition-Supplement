<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;

class ApiResponse implements Responsable
{
    protected int $httpCode;
    protected array $data;
    protected string $errorMessage;
    public function __construct(int $httpCode,array $data,string $errorMessage=''){
        $this->httpCode = $httpCode;
        $this->data = $data;
        $this->errorMessage = $errorMessage;
    }
    public function toResponse($request): \Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
    {
        $payload = match (true) {
            $this->httpCode >= 500 => ['errorMessage' => 'Server error'],
            $this->httpCode >= 400 => ['errorMessage' => $this->errorMessage],
            $this->httpCode >= 200 => ['data' => $this->data],
        };
        return response()-> json(
            data : $payload,
            status : $this->httpCode,
            options : JSON_UNESCAPED_UNICODE
        );
    }
    public static function success(string $message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => $message
        ]);
    }
    public static function fail(string $message): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            "message" => $message
        ],400);
    }
}
