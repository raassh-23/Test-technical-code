<?php

namespace Raassh23\TechnicalTest\Controller;

class GanjilController extends BaseController
{
    public function handle(string $path, string $method): string
    {
        if (preg_match('/^\/ganjil\/?$/i', $path)) {
            if ($method !== "GET") {
                return $this->response('Method not allowed', 405);
            }

            return $this->generateGanjil();
        }

        return self::notFound();
    }

    private function generateGanjil(): string
    {
        $input = trim($_GET['input'] ?? "");

        if (!ctype_digit($input)) {
            return $this->response('Input must be a number', 400);
        }

        $input = intval($input);

        $result = [];

        for ($i = 1; $i <= $input; $i += 2) {
            array_push($result, $i);
        }

        return $this->response('Success', 200, $result);
    }
}
