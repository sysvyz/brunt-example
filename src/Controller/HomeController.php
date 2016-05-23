<?php
namespace Svz\Controller;

use BruntTest\Testobjects\Car;
use Doctrine\ORM\EntityManager;
use Svz\Entity\Product;
use Svz\Service\DBService;
use Svz\Service\SomeService;
use Symfony\Component\HttpFoundation\Request;

class HomeController implements ControllerInterface
{
    /**
     * @var SomeService
     */
    private $service;
    /**
     * @var EntityManager
     */
    private $entityManager;
    /**
     * @var SomeService
     */
    private $someService;
    
    public static function _DI_PROVIDERS()
    {
        return [
        ];
    }
    /**
     * HomeController constructor.
     * @param Request $request
     * @param DBService|SomeService $service
     * @param SomeService $someService
     * @param EntityManager $entityManager
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


}