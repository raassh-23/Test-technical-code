<?php

namespace Raassh23\TechnicalTest\Controller;

class SegitigaController extends BaseController
{
    public function handle(string $path, string $method): string
    {
        if (preg_match('/^\/segitiga\/?$/i', $path)) {
            if ($method !== "GET") {
                return $this->response('Method not allowed', 405);
            }

            return $this->generateSegitiga();
        }

        return self::notFound();
    }

    private function generateSegitiga(): string
    {
        $input = trim($_GET['input'] ?? "");

        if (!ctype_digit($input)) {
            return $this->response('Input must be a number', 400);
        }

        $digits = str_split($input);

        $result = array_map(
            fn ($digit, $index) => $digit . str_repeat("0", $index + 1),
            $digits,
            array_keys($digits)
        );

        return $this->response('Success', 200, $result);
    }
}
