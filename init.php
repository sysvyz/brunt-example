<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 18.04.16
 * Time: 16:21
 */

use Svz\App;
use Svz\Controller\HomeController;
use Brunt\Injector;
use Brunt\Testobjects;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

use Brunt\Binding;
use Svz\Dispatcher;
use Symfony\Component\HttpFoundation\Request;

use function \Brunt\bind;

require __DIR__ . '/vendor/autoload.php';

function bootstrap()
{
    $injector = new Injector();

    $injector->bind([
        Binding::init('%BASE_DIR%')->toValue(__DIR__),

        /*
         * App
         */
        bind(App::class)
            ->toClass(App::class),

        bind(HomeController::class)
            ->toClass(HomeController::class),

        bind(Dispatcher::class)
            ->toClass(Dispatcher::class),

        bind(Request::class)
            ->toFactory(function () {
                return Request::createFromGlobals();
            })

    ]);

    return $injector;
}

