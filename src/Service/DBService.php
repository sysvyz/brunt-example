<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 14.05.16
 * Time: 21:44
 */

namespace Svz\Service;


use Doctrine\ORM\EntityManager;
use Svz\Entity\I\Entity;
use Svz\Service\QueryBuilder as SvzQueryBuilder;


class DBService
{

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * ProductService constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    public function save(Entity $entity)
    {
        $entityManager = $this->entityManager;
        $entityManager->persist($entity);
        $entityManager->flush();
    }

    /**
     * @return SvzQueryBuilder
     */
    public function getQueryBuilder()
    {
        return  new SvzQueryBuilder($this->entityManager->createQueryBuilder());
    }

    /**
     * @param Entity[] $entities
     */
    public function saveAll(array $entities)
    {
        $entityManager = $this->entityManager;
        foreach ($entities as $entity) {
            $entityManager->persist($entity);
        }
        $entityManager->flush();
    }


}