<?php
use Brunt\Injector;
use Brunt\Invoker;
use Svz\App;
use Svz\Dispatcher;
use function Brunt\bind;


/**
 * @param Injector $injector
 */
return [

    bind(App::class)->singleton(),
    bind(Dispatcher::class)->singleton(),
    bind(\Brunt\Invoker::class)->toFactory(function (Injector $injector){
        return new Invoker($injector);
    })->singleton(),
];
