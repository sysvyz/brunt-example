<?php

namespace Svz;


use Brunt\InjectableInterface;
use Brunt\Invoker;
use Klein\AbstractRouteFactory;
use Klein\DataCollection\RouteCollection;
use Klein\Klein;
use Klein\Request;
use Klein\Response;
use Klein\ServiceProvider;


class Dispatcher extends Klein implements InjectableInterface
{

    public function __construct(
        ServiceProvider $service = null,
        $app = null,
        RouteCollection $routes = null,
        AbstractRouteFactory $route_factory = null)
    {
        parent::__construct($service, $app, $routes, $route_factory);
    }

    public static function _DI_DEPENDENCIES()
    {
        return [
            'app' => App::class,
        ];
    }

    public static function _DI_PROVIDERS()
    {
        return [

        ];
    }

    public function respond($method, $path = '*',  $callback = null)
    {
        // Get the arguments in a very loose format
        extract(
            $this->parseLooseArgumentOrder(func_get_args()),
            EXTR_OVERWRITE
        );

        if(is_array($callback)){

            $callback = function (Request $request,
                                  Response $response,
                                  ServiceProvider $service,
                                  App $app,
                                  Dispatcher $dispatcher,
                                  RouteCollection $matched,
                                  $methods_matched)use ($callback){
                if($matched->count()>0){
                    return;
                }

                $injector = $app->getInjector();
                $controller = $injector->{$callback[0]};

                /** @var Invoker $invoker */
                $invoker = $injector->get(Invoker::class);
                try{
                    $res =  $invoker->invoke($controller,$callback[1]);
                    return $res;
                }catch (\ReflectionException $e){
                    var_dump($e->getMessage());
                }

            };
        }
        return parent::respond($method, $path, $callback);
    }
}
