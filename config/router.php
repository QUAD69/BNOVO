<?php
declare(strict_types=1);

use Phalcon\Mvc\Router;

$router = new Router(false);

$router->addGet('/guests', 'Guest::browse');
$router->addPut('/guests', 'Guest::compose');
$router->addGet('/guests/{id:\d+}', 'Guest::view');
$router->addPatch('/guests/{id:\d+}', 'Guest::compose');
$router->addDelete('/guests/{id:\d+}', 'Guest::delete');

$router->notFound('Base::notFound');

return $router;