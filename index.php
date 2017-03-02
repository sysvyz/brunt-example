<?php
use Brunt\Exception\ProviderNotFoundException;
use Svz\Dispatcher;
print_r($argv);
include "init.php";
$injector = bootstrap();

/** @var Dispatcher $dispatcher */
$dispatcher = $injector->{Dispatcher::class};

$dispatcher->respond('GET', '/other/json', [\Svz\Controller\OtherController::class, "asJSON"]);
$dispatcher->respond('GET', '/other/products', [\Svz\Controller\OtherController::class, "products"]);
$dispatcher->respond('GET', '/other/[:name]', [\Svz\Controller\OtherController::class, "show"]);
$dispatcher->respond('GET', '/other', [\Svz\Controller\OtherController::class, "index"]);

$dispatcher->respond('/', [\Svz\Controller\HomeController::class, 'index']);
$dispatcher->respond('/add', [\Svz\Controller\HomeController::class, 'execute']);

$dispatcher->respond('*', [\Svz\Controller\ErrorController::class, 'pageDoesNotExist']);

try {

    $dispatcher->dispatch($injector->{\Klein\Request::class});


} catch (ProviderNotFoundException $e) {
    var_dump($e->getMessage());
    var_dump($e->getFile());
    var_dump($e->getLine());
}


