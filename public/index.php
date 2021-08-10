<?php

use App\Application;
use App\Exception\AbstractHttpException;
use App\Service\Http\HttpStatusCode;

require_once __DIR__.'/../vendor/autoload.php';

try {
    $app = Application::getInstance();
    $response = $app->run();
    $response->send();
} catch (AbstractHttpException $e) {
    http_response_code($e->getCode());
    header('Content-Type: application/json');
    echo json_encode(
        [
            'reason' => $e->getMessage(),
        ]
    );
} catch (\Throwable $e) {
    http_response_code(HttpStatusCode::INTERNAL_SERVER_ERROR);
    header('Content-Type: application/json');
    echo json_encode(
        [
            'reason' => $e->getMessage(),
        ]
    );
}
