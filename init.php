<?php

use Brunt\Binding;
use Brunt\Injector;
use function Brunt\bind;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Svz\App;
use Svz\Dispatcher;

use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Loader\LoaderResolver;
use Symfony\Component\Config\Loader\DelegatingLoader;

$configDirectories = array(__DIR__.'/app/config');

$locator = new FileLocator($configDirectories);
$yamlUserFiles = $locator->locate('users.yml', null, false);


$delegatingLoader->load(__DIR__.'/users.yml');
/*
The YamlUserLoader will be used to load this resource,
since it supports files with a "yml" extension
*/
function bootstrap($DIR)
{
    require_once $DIR . '/vendor/autoload.php';
    Binding::init('');//require Binding;

    $injector = new Injector();
    
    $injector->bind(

        bind('%ENV:BASE_DIR%')
            ->toValue($DIR),
        
        bind("%ENV:DEV%")
            ->toFactory(function (Injector $injector) {
                return true;
            }),
        
        bind("%ENV:DB:CONFIG:PATH%")
            ->singleton()
            ->toFactory(function (Injector $injector) {
                return $injector->{'%ENV:BASE_DIR%'} . "/config/database.php";
            }),

        bind("%DOCTRINE:CONFIG:PATH%")
            ->singleton()
            ->toFactory(function (Injector $injector) {
                return [$injector->{'%ENV:BASE_DIR%'} . "/config/xml/orm"];
            }),

        bind(EntityManager::class)->toFactory(function (Injector $injector) {

            $injector->bind(
                    bind("%DOCTRINE:DB:PARAMS%")
                        ->toFactory(function (Injector $injector) {
                            return include($injector->{"%ENV:DB:CONFIG:PATH%"});
                        })
                        ->singleton(),
                    bind(Configuration::class)
                        ->toFactory(function (Injector $injector) {
                            return Setup::createXMLMetadataConfiguration(
                                $injector->{"%DOCTRINE:CONFIG:PATH%"},
                                $injector->{"%ENV:DEV%"}
                            );
                        })
                        ->lazy()
                        ->singleton()

            );

            return EntityManager::create(
                $injector->{"%DOCTRINE:DB:PARAMS%"},
                $injector->{Configuration::class}
            );
        }),


        bind(App::class)
            ->lazy()
            ->singleton(),

        bind(Dispatcher::class)
            ->toClass(Dispatcher::class)
            ->singleton()
            ->lazy(),

        bind(Request::class)
            ->toFactory(function () {

                static $request = null;
                if ($request === null) {
                    $request = Request::createFromGlobals();
                }
                return $request;
            })
            ->singleton()

    );

    return $injector;
}

