<?php
declare(strict_types=1);

use Phalcon\Cache\AdapterFactory;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Di\Di;
use Phalcon\Filter\FilterFactory;
use Phalcon\Http\Request;
use Phalcon\Http\Response;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\Model\Manager as ModelManager;
use Phalcon\Mvc\Router;
use Phalcon\Storage\SerializerFactory;

$di = new Di();

$di->setShared('request', new Request());

$di->setShared('response', new Response());

$di->setShared('router', new Router(false));

$di->setShared('config', require BASE_PATH . '/config/config.php');

$di->setShared('router', require BASE_PATH . '/config/router.php');

$di->setShared('filter', function() {
    $factory = new FilterFactory();
    return $factory->newInstance();
});

$di->setShared('db', function () {
    $config = $this->getConfig()->database;
    return new Mysql($config->toArray());
});

$di->setShared('dispatcher', function() {
    $dispatcher = new Dispatcher();
    $dispatcher->setDI($this);
    $dispatcher->setDefaultNamespace('App\\Controllers');

    return $dispatcher;
});

$di->setShared('modelsManager', function() {
    $manager = new ModelManager();
    $manager->setDI($this);

    return $manager;
});

$di->setShared('modelsMetadata', function() {
    $serializer = new SerializerFactory();
    $factory = new AdapterFactory($serializer);

    return new MetaDataAdapter($factory);
});

return $di;