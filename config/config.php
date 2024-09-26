<?php
declare(strict_types=1);

use Phalcon\Config\Config;

return new Config([
    'database' => [
        'host'      => '127.0.0.1',
        'username'  => 'root',
        'password'  => 'root',
        'dbname'    => 'bnovo',
        'charset'   => 'utf8mb4'
    ]
]);