<?php
namespace Svz;

use Brunt\InjectableInterface;
use Brunt\Injector;
use Svz\Controller\AbstractController;
use Svz\Controller\HomeController;
use Svz\Controller\OtherController;
use Svz\Service\DBService;
use Symfony\Component\HttpFoundation\Request;


class App implements InjectableInterface
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
     * @var Request
     */
    private $request;

    public static function _DI_DEPENDENCIES()
    {
        return [];
    }

    public static function _DI_PROVIDERS()
    {
        return [
            OtherController::class,
            HomeController::class,
            DBService::class
        ];
    }
    /**
     * App constructor.
     * @param Injector $injector
     * @param Request $request
     * @param Dispatcher $dispatcher
     */
    public function __construct(Injector $injector,
                                Dispatcher $dispatcher,
                                Request $request
    )
    {
        echo 'App.construct...' . PHP_EOL;
        $this->injector = $injector;
        $this->dispatcher = $dispatcher;
        $this->request = $request;
    }

    public function run()
    {

        echo 'App.run...' . PHP_EOL;

        /** @var string $controllerToken */
        $controllerToken = $this->dispatcher->dispatch();
        /** @var AbstractController $controller */
        $controller = $this->injector->{$controllerToken};

        $controller->execute();

    }

}
