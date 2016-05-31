<?php
namespace Svz\Controller;


use Klein\Request;
use Svz\Entity\Product;
use Svz\Service\DBService;

class HomeController
{
    /**
     * @var DBService
     */
    private $service;

    /**
     * @var Request
     */
    private $request;


    public static function _DI_PROVIDERS()
    {
        return [
        ];
    }
    /**
     * HomeController constructor.
     * @param Request $request
     * @param DBService $service
     */
    public function __construct(Request $request, DBService $service)
    {

        $this->service = $service;
        $this->request = $request;
    }

    public function execute()
    {

        $product = new Product();
        $product->setName('p:' . md5(microtime()));
        $product->setPrice((float)rand(1,10000)/100);

        $this->service->save($product);

        echo "Created Product: " . $product->getName() . " with ID " . $product->getId() . "\n";
        

    }


    public function index(){


        $product = new Product();
        $product->setName('p:' . md5(microtime()));
        $product->setPrice((float)rand(1,10000)/100);

        $this->service->save($product);

        echo "Created Product: " . $product->getName() . " with ID " . $product->getId() . "<br>\n";

        echo "Home@index";
    }
}