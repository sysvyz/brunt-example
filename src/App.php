<?php
namespace Svz;

use Brunt\Injectable;
use Brunt\Injector;
use Svz\Controller\HomeController;
use Symfony\Component\HttpFoundation\Request;


class App extends Injectable
{
    /**
     * @var Logger
     */
    private $logger;

    /**
     * @var Injector
     */
    private $injector;


    /**
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * App constructor.
     * @param Injector $injector
     * @param Request $request
     * @param Dispatcher $dispatcher
     */
    public function __construct(Injector $injector,
                                Dispatcher $dispatcher
    )
    {

        $this->injector = $injector;
        $this->dispatcher = $dispatcher;
    }

    public function run()
    {

        $controllerToken = $this->dispatcher->dispatch();
        /** @var HomeController $controller */
        $controller = $this->injector->{$controllerToken};
        $controller->execute();

    }
}
