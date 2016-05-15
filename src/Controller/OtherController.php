<?php

namespace Svz\Controller;


use Svz\Entity\Product;
use Svz\Service\DBService;

class OtherController implements ControllerInterface
{
    /**
     * @var DBService
     */
    private $service;

    /**
     * OtherController constructor.
     * @param DBService $service
     */
    public function __construct(DBService $service){

        $this->service = $service;
    }



    public function execute()
    {
        echo 'OtherController.execute'.PHP_EOL;
        $qry = $this->service->getQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->where('p.id > ?1')
            ->orderBy('p.name', 'ASC')
            ->setMaxResults(15)
            ->setParameter(1, 3);;
        $result = $qry->getQuery()->getCollectionResult();

//        print_r($result);
        var_dump($result->filter(function (Product $product) {
            return $product->getId() < 10;
        })->toArray());


        echo 'done'.PHP_EOL;
    }
}