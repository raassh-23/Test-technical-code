<?php

namespace Raassh23\TechnicalTest\app;

use Raassh23\TechnicalTest\Controller\BaseController;
use Raassh23\TechnicalTest\Controller\GanjilController;
use Raassh23\TechnicalTest\Controller\PrimaController;
use Raassh23\TechnicalTest\Controller\SegitigaController;

require_once dirname(__DIR__, 2) . '/vendor/autoload.php';

// CORS support
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

header("Content-Type: application/json");

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$paths = explode('/', $path);

if ($method === "OPTIONS") { // handle preflight request
    http_response_code(200);
    exit();
} elseif ($paths[1] === "segitiga") {
    echo (new SegitigaController())->handle($path, $method);
} elseif ($paths[1] === "ganjil") {
    echo (new GanjilController())->handle($path, $method);
} elseif ($paths[1] === "prima") {
    echo (new PrimaController())->handle($path, $method);
} else {
    echo BaseController::notFound();
}
