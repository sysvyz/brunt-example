<?php


use Brunt\Injector;
use Klein\AbstractRouteFactory;
use Klein\DataCollection\RouteCollection;
use Klein\Request;
use Klein\Response;
use Klein\RouteFactory;
use Klein\ServiceProvider;
use function Brunt\bind;

return [


    bind(AbstractRouteFactory::class)->toFactory(function (Injector $injector) {
        $v = new RouteFactory();
        return $v;
    })
        ->singleton(),

    bind(RouteCollection::class)->toFactory(function (Injector $injector) {
        $v = new RouteCollection();
        return $v;
    })
        ->singleton(),

    bind(ServiceProvider::class)->toFactory(function (Injector $injector) {
        $v = new ServiceProvider($injector->{Request::class});
        return $v;
    })->singleton(),
    bind(Request::class)
        ->toFactory(function (\Brunt\Injector $injector) {

            static $request;
            if(!$request){

                $request = Request::createFromGlobals();
                // Grab the server-passed "REQUEST_URI"


                $base = explode('/',$request->server()->get('SCRIPT_NAME'));
                array_pop($base);
                $base = implode('/',$base);

                $uri = $request->server()->get('REQUEST_URI');

                $strippedUri = substr($uri, strlen($base));

                $parts = explode('?', $strippedUri);

                $strippedUri = '/' .
                    implode(
                        '?',
                        [
                            implode('/',
                                array_filter(explode('/', $parts[0]))
                            ),
                            $parts[1]
                        ]
                    );
                // Set the request URI to a modified one (without the "subdirectory") in it
                $request->server()->set('REQUEST_URI', $strippedUri);
            }

            return $request;
        })->singleton(),

    bind(Response::class)
        ->toFactory(function (\Brunt\Injector $injector) {
            return new Response();
        })->singleton(),

    bind(ServiceProvider::class)
        ->toFactory(function (\Brunt\Injector $injector) {
            return new ServiceProvider($injector->{Request::class}, $injector->{Response::class});
        })->singleton(),

];