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
use Svz\Controller\OtherController;
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


    public function dispatch()
    {




        $path = [];

       
        $hasArgs = $this->request->server->has('argv');

        if($hasArgs){
            $arr = $this->request->server->get('argv');
            array_shift($arr);
            $path = $arr;
        }else{
            $path = explode('/', rtrim($this->request->query->get('%REWRITE_URL%'), " /"));
        }




        $mapping = [
            'aaa' => HomeController::class,
            'other' => OtherController::class,


        ];


        if(sizeof($path) && isset($mapping[$path[0]])){
            return $mapping[$path[0]];
        }



        return HomeController::class;

    }

}

class UrlPath {

    

}