<?php
namespace Svz;

use Brunt\Injector;
use Klein\Request;
use Svz\Service\DBService;


class App extends \Klein\App
{
    /**
     * @var Injector
     */
    private $injector;


    /**
     * App constructor.
     * @param Injector $injector
     */
    public function __construct(Injector $injector)
    {
        $this->injector = $injector;
    }

    public static function _DI_DEPENDENCIES()
    {
        return [];
    }

    public static function _DI_PROVIDERS()
    {
        return [
            DBService::class
        ];
    }

    /**
     * @return Injector
     */
    public function getInjector()
    {
        return $this->injector;
    }

}
