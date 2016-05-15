<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 18.04.16
 * Time: 16:21
 */

use Brunt\Binding;
use Brunt\Injector;
use function Brunt\bind;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Svz\App;
use Svz\Controller\HomeController;
use Svz\Dispatcher;

use Symfony\Component\HttpFoundation\Request;


function bootstrap($DIR)
{
    echo '...bootstrap...' . PHP_EOL;
    require_once $DIR . '/vendor/autoload.php';
    Binding::init('');//require Binding;

    $injector = new Injector();
    
    $injector->bind([

        bind('%ENV:BASE_DIR%')
            ->toValue($DIR),
        
        bind("%ENV:DEV%")
            ->toFactory(function (Injector $injector) {
                return true;
            }),
        
        bind("%ENV:DB:CONFIG:PATH%")
            ->toFactory(function (Injector $injector) {
                return $injector->{'%ENV:BASE_DIR%'} . "/config/database.php";
            })->singleton(),

        bind("%DOCTRINE:CONFIG:PATH%")
            ->toFactory(function (Injector $injector) {
                return [$injector->{'%ENV:BASE_DIR%'} . "/config/xml/orm"];
            })
            ->singleton(),

        bind(EntityManager::class)->toFactory(function (Injector $injector) {

            $injector->bind([
                    
                    bind("%DOCTRINE:DB:PARAMS%")
                        ->toFactory(function (Injector $injector) {
                            return include($injector->{"%ENV:DB:CONFIG:PATH%"});
                        })
                        ->singleton(),
                    bind("%DOCTRINE:CONFIG%")
                        ->toFactory(function (Injector $injector) {
                            return Setup::createXMLMetadataConfiguration(
                                $injector->{"%DOCTRINE:CONFIG:PATH%"},
                                $injector->{"%ENV:DEV%"}
                            );
                        })
                        ->singleton(),
                ]
            );

            return EntityManager::create(
                $injector->{"%DOCTRINE:DB:PARAMS%"},
                $injector->{"%DOCTRINE:CONFIG%"}
            );
        }),


        bind(App::class)->lazy()->singleton(),

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

