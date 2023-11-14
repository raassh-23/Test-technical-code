<?php

namespace Raassh23\TechnicalTest\Controller;

abstract class BaseController
{
    protected function response(string $message, int $code = 200, ?array $data = null): string
    {
        http_response_code($code);

        $response = [
            'error' => $code >= 400,
            'message' => $message,
        ];

        if ($data) {
            $response['data'] = $data;
        }

        return json_encode($response);
    }

    public abstract function handle(string $path, string $method): string;

    public static function notFound(): string
    {
        http_response_code(404);
        return json_encode([
            'error' => true,
            'message' => 'Not found',
        ]);
    }
}
