<?php
use Brunt\Injector;
use Brunt\Reflection\Invoker;
use Svz\App;
use Svz\Dispatcher;
use function Brunt\bind;


/**
 * @param Injector $injector
 */
return [

    bind(App::class)->singleton(),
    bind(Dispatcher::class)->singleton(),
    bind(Invoker::class)->toFactory(function (Injector $injector){
        return new Invoker($injector);
    })->singleton(),
];
