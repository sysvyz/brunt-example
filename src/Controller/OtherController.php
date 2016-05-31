<?php

namespace Svz\Controller;


use Doctrine\ORM\EntityManager;
use Klein\Request;
use Klein\Response;
use Svz\Entity\Product;
use Svz\Service\DBService;

class OtherController
{
    /**
     * @var DBService
     */
    private $service;

    /**
     * OtherController constructor.
     * @param DBService $service
     */
    public function __construct(DBService $service)
    {

        $this->service = $service;
    }


    public function products(EntityManager $entityManager, Response $response)
    {
        return $response->json(
            $entityManager->createQueryBuilder()
                ->select('p')
                ->from(Product::class, 'p')
                ->getQuery()
                ->getArrayResult());
    }

    public function index()
    {
        echo "Other::index";
    }

    public function asJson(Request $request, Response $response)
    {

        return $response->json($request->paramsGet()->all());
    }

    public function show(Request $request)
    {
        echo "Other@show name: " . $request->name;
    }

    public function execute()
    {
        $qry = $this->service->getQueryBuilder()
            ->select('p')
            ->from(Product::class, 'p')
            ->where('p.id > ?1')
            ->orderBy('p.name', 'ASC')
            ->setMaxResults(15)
            ->setParameter(1, 3);
        $result = $qry->getQuery()->getCollectionResult();

        var_dump($result->filter(function (Product $product) {
            return $product->getId() < 10;
        })->toArray());

    }
}