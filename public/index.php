<?php
declare(strict_types=1);

use Phalcon\Mvc\Application;

require '../vendor/autoload.php';

define('BASE_PATH', realpath(__DIR__ . '/../'));
define('APP_PATH', BASE_PATH . '/App');

if (isset($_SERVER['CONTENT_TYPE']) and str_starts_with($_SERVER['CONTENT_TYPE'], 'application/json')) {
    $_POST = @json_decode(file_get_contents('php://input'), true, 16) ?? [];
}

try {
    $di = require BASE_PATH . '/config/services.php';

    $application = new Application($di);
    $application->useImplicitView(false);
    $application->handle($_SERVER['REQUEST_URI'])->send();
} catch (Exception $exception) {
    header('Content-Type: text/plain', response_code: 500);
    echo $exception->getMessage(), PHP_EOL;
    echo $exception->getTraceAsString();
}