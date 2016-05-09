<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 18.04.16
 * Time: 16:21
 */

use Brunt\Injector;
use Brunt\Binding;
use function \Brunt\bind;

use Svz\App;
use Svz\Controller\HomeController;
use Svz\Dispatcher;

use Symfony\Component\HttpFoundation\Request;


function bootstrap($DIR)
{
    require $DIR . '/vendor/autoload.php';
    $injector = new Injector();

    $injector->bind([
        Binding::init('%BASE_DIR%')->toValue($DIR),

        /*
         * App
         */
        bind(App::class)
            ->toClass(App::class)->lazy()->singleton(),

        bind(HomeController::class)
            ->toClass(HomeController::class)->singleton(),

        bind(Dispatcher::class)
            ->toClass(Dispatcher::class),

        bind(Request::class)
            ->toFactory(function () {

                static $request = null;
                if ($request === null) {
                    $request = Request::createFromGlobals();
                }
                return $request;
            })->singleton()

    ]);

    return $injector;
}

