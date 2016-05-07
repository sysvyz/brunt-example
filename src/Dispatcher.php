<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 21.04.16
 * Time: 01:32
 */

namespace Svz;


use Brunt\Injectable;
use Brunt\Injector;
use Svz\Controller\HomeController;
use Symfony\Component\HttpFoundation\Request;


class Dispatcher extends Injectable
{
    /**
     * @var Request
     */
    private $request;


    /**
     * Dispatcher constructor.
     * @param Request $request
     * @param Injector $injector
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    public function dispatch(){
        $path = explode('/',rtrim($this->request->query->get('%REWRITE_URL%')," /"));

        //do some logic

        return HomeController::class;

    }

}