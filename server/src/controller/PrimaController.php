<?php

namespace Raassh23\TechnicalTest\Controller;

class PrimaController extends BaseController
{
    public function handle(string $path, string $method): string
    {
        if (preg_match('/^\/prima\/?$/i', $path)) {
            if ($method !== "GET") {
                return $this->response('Method not allowed', 405);
            }

            return $this->generatePrima();
        }

        return self::notFound();
    }

    private function checkPrima(int $x): bool
    {
        for ($i = 2; $i * $i <= $x; $i++) {
            if ($x % $i == 0) {
                return false;
            }
        }

        return true;
    }

    private function generatePrima(): string
    {
        $input = trim($_GET['input'] ?? "");

        if (!ctype_digit($input)) {
            return $this->response('Input must be a number', 400);
        }

        $input = intval($input);

        $result = [];

        for ($i = 2; $i <= $input; $i++) {
            if ($this->checkPrima($i)) {
                array_push($result, $i);
            }
        }

        return $this->response('Success', 200, $result);
    }
}
