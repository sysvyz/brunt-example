<?php
/**
 * Created by PhpStorm.
 * User: mb
 * Date: 15.05.16
 * Time: 00:49
 */

namespace Svz\Service;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\DBAL\Cache\QueryCacheProfile;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder as DoctrineQueryBuilder;

class QueryBuilder
{
    /**
     * @var DoctrineQueryBuilder
     */
    private $queryBuilder;


    /**
     * QueryBuilders constructor.
     * @param DoctrineQueryBuilder $queryBuilder
     */
    public function __construct(DoctrineQueryBuilder $queryBuilder)
    {

        $this->queryBuilder = $queryBuilder;
    }

    public function expr()
    {
        return $this->queryBuilder->expr(); 
    }

    public function getType()
    {
        return $this->queryBuilder->getType(); 
    }

    public function getEntityManager()
    {
        return $this->queryBuilder->getEntityManager(); 
    }

    public function getState()
    {
        return $this->queryBuilder->getState(); 
    }

    public function getDQL()
    {
        return $this->queryBuilder->getDQL(); 
    }

    /**
     * @return Query
     */
    public function getQuery()
    {
        
        return new Query($this->queryBuilder->getQuery());
        
        
        
    }

    public function getRootAlias()
    {
        return $this->queryBuilder->getRootAlias(); 
    }

    public function getRootAliases()
    {
        return $this->queryBuilder->getRootAliases(); 
    }

    public function getRootEntities()
    {
        return $this->queryBuilder->getRootEntities(); 
    }

    public function setParameter($key, $value, $type = null)
    {
        $this->queryBuilder->setParameter($key, $value, $type); 
        return $this; 
    }

    public function setParameters($parameters)
    {
        $this->queryBuilder->setParameters($parameters); 
        return $this;
    }

    public function getParameters()
    {
        return $this->queryBuilder->getParameters(); 
    }

    public function getParameter($key)
    {
        return $this->queryBuilder->getParameter($key); 
    }

    public function setFirstResult($firstResult)
    {
        $this->queryBuilder->setFirstResult($firstResult); 
        return $this;
    }

    public function getFirstResult()
    {
        return $this->queryBuilder->getFirstResult(); 
    }

    public function setMaxResults($maxResults)
    {
         $this->queryBuilder->setMaxResults($maxResults); 
        return $this;  }

    public function getMaxResults()
    {
        return $this->queryBuilder->getMaxResults(); 
    }

    public function add($dqlPartName, $dqlPart, $append = false)
    {
        $this->queryBuilder->add($dqlPartName, $dqlPart, $append); 
        return $this;}

    public function select($select = null)
    {
        $this->queryBuilder = $this->queryBuilder->select($select); 
        return $this;
    }

    public function distinct($flag = true)
    {
         $this->queryBuilder->distinct($flag); 
        return $this; }

    public function addSelect($select = null)
    {
        $this->queryBuilder->addSelect($select); 
        return $this;
    }

    public function delete($delete = null, $alias = null)
    {
         $this->queryBuilder->delete($delete, $alias); 
        return $this;}

    public function update($update = null, $alias = null)
    {
         $this->queryBuilder->update($update, $alias); 
        return $this; }

    public function from($from, $alias, $indexBy = null)
    {
         $this->queryBuilder->from($from, $alias, $indexBy); 
        return $this;}

    public function join($join, $alias, $conditionType = null, $condition = null, $indexBy = null)
    {
        $this->queryBuilder->join($join, $alias, $conditionType, $condition, $indexBy); 
        return $this;
    }

    public function innerJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null)
    {
         $this->queryBuilder->innerJoin($join, $alias, $conditionType, $condition, $indexBy); 
        return $this; }

    public function leftJoin($join, $alias, $conditionType = null, $condition = null, $indexBy = null)
    {
         $this->queryBuilder->leftJoin($join, $alias, $conditionType, $condition, $indexBy); 
        return $this;
    }

    public function set($key, $value)
    {
         $this->queryBuilder->set($key, $value); 
        return $this;
    }

    public function where($predicates)
    {
         $this->queryBuilder->where($predicates); 
        return $this;
    }

    public function andWhere($where)
    {
         $this->queryBuilder->andWhere($where); 
        return $this;
    }

    public function orWhere($where)
    {
         $this->queryBuilder->orWhere($where); 
        return $this;
    }

    public function groupBy($groupBy)
    {
        $this->queryBuilder->groupBy($groupBy); 
        return $this;
    }

    public function addGroupBy($groupBy)
    {
         $this->queryBuilder->addGroupBy($groupBy); 
        return $this;
    }

    public function having($having)
    {
         $this->queryBuilder->having($having); 
        return $this;
    }

    public function andHaving($having)
    {
        $this->queryBuilder->andHaving($having); 
        return $this;
    }

    public function orHaving($having)
    {

         $this->queryBuilder->orHaving($having); 
        return $this;
    }

    public function orderBy($sort, $order = null)
    {
         $this->queryBuilder->orderBy($sort, $order); 
        return $this;
    }

    public function addOrderBy($sort, $order = null)
    {
         $this->queryBuilder->addOrderBy($sort, $order); 
        return $this;
    }

    public function addCriteria(Criteria $criteria)
    {
         $this->queryBuilder->addCriteria($criteria); 
        return $this;
    }

    public function getDQLPart($queryPartName)
    {
        return $this->queryBuilder->getDQLPart($queryPartName); 
    }

    public function getDQLParts()
    {
        return $this->queryBuilder->getDQLParts(); 
    }

    public function resetDQLParts($parts = null)
    {
        $this->queryBuilder->resetDQLParts($parts); 
        return $this;
    }

    public function resetDQLPart($part)
    {
        $this->queryBuilder->resetDQLPart($part); 
        return $this;
    }


    /**
     * Gets the SQL query that corresponds to this query object.
     * The returned SQL syntax depends on the connection driver that is used
     * by this query object at the time of this method call.
     *
     * @return string SQL query
     */
    public function getSQL()
    {
        // TODO: Implement getSQL() method.
    }

    /**
     * Executes the query and returns a the resulting Statement object.
     *
     * @return \Doctrine\DBAL\Driver\Statement The executed database statement that holds the results.
     */
    protected function _doExecute()
    {
        // TODO: Implement _doExecute() method.
    }
}


class Query  extends AbstractQuery{
    /**
     * @var \Doctrine\ORM\Query
     */
    private $query;

    public function __construct(\Doctrine\ORM\Query $query)
    {
        parent::__construct($query->_em);
        $this->query = $query;
    }

    public function getEntityManager()
    {
        return $this->query->getEntityManager();
    }

    public function getParameters()
    {
        return $this->query->getParameters();
    }

    public function getParameter($key)
    {
        return $this->query->getParameter($key);
    }

    public function setParameters($parameters)
    {
        $this->query->setParameters($parameters);
        return $this;}

    public function setParameter($key, $value, $type = null)
    {
         $this->query->setParameter($key, $value, $type);
        return $this; }

    public function processParameterValue($value)
    {
        return $this->query->processParameterValue($value);
    }

    public function setResultSetMapping(\Doctrine\ORM\Query\ResultSetMapping $rsm)
    {
        $this->query->setResultSetMapping($rsm);
        return $this;}

    public function setHydrationCacheProfile(QueryCacheProfile $profile = null)
    {
        $this->query->setHydrationCacheProfile($profile);
        return $this; }

    public function getHydrationCacheProfile()
    {
        return $this->query->getHydrationCacheProfile();
    }

    public function setResultCacheProfile(QueryCacheProfile $profile = null)
    {
        $this->query->setResultCacheProfile($profile);
        return $this;}

    public function setResultCacheDriver($resultCacheDriver = null)
    {
        $this->query->setResultCacheDriver($resultCacheDriver);
        return $this; }

    public function useResultCache($bool, $lifetime = null, $resultCacheId = null)
    {
         $this->query->useResultCache($bool, $lifetime, $resultCacheId);
        return $this; }

    public function setResultCacheLifetime($lifetime)
    {
         $this->query->setResultCacheLifetime($lifetime);
        return $this;  }

    /**
     * Retrieves the lifetime of resultset cache.
     *
     * @deprecated
     *
     * @return integer
     */
    public function getResultCacheLifetime()
    {
        return $this->query->getResultCacheLifetime();
    }

    public function expireResultCache($expire = true)
    {
         $this->query->expireResultCache($expire);
        return $this; }

    public function getExpireResultCache()
    {
        return $this->query->getExpireResultCache();
    }

    public function getQueryCacheProfile()
    {
        return $this->query->getQueryCacheProfile();
    }

    public function setFetchMode($class, $assocName, $fetchMode)
    {
         $this->query->setFetchMode($class, $assocName, $fetchMode);
        return $this; }

    public function getHydrationMode()
    {
        return $this->query->getHydrationMode();
    }

    public function getResult($hydrationMode = \Doctrine\ORM\Query::HYDRATE_OBJECT)
    {
        return $this->query->getResult($hydrationMode);
    }

    public function getArrayResult()
    {
        return $this->query->getArrayResult(); 
    }
    public function getCollectionResult()
    {
        return  new ArrayCollection($this->query->getResult(\Doctrine\ORM\Query::HYDRATE_OBJECT));
    }
    public function getScalarResult()
    {
        return $this->query->getScalarResult();
    }

    public function getOneOrNullResult($hydrationMode = null)
    {
        return $this->query->getOneOrNullResult($hydrationMode);
    }

    public function getSingleResult($hydrationMode = null)
    {
        return $this->query->getSingleResult($hydrationMode);
    }

    public function getSingleScalarResult()
    {
        return $this->query->getSingleScalarResult();
    }

    public function getHint($name)
    {
        return $this->query->getHint($name);
    }

    public function hasHint($name)
    {
        return $this->query->hasHint($name);
    }

    public function getHints()
    {
        return $this->query->getHints();
    }

    public function execute($parameters = null, $hydrationMode = null)
    {
        return $this->query->execute($parameters, $hydrationMode);
    }

    protected function getHydrationCacheId()
    {
        return $this->query->getHydrationCacheId();
    }

    public function setResultCacheId($id)
    {
         $this->query->setResultCacheId($id);
        return $this; }

    public function getResultCacheId()
    {
        return $this->query->getResultCacheId();
    }

    public function getSQL()
    {
        return $this->query->getSQL();
    }

    public function getAST()
    {
        return $this->query->getAST();
    }

    public function setQueryCacheDriver($queryCache)
    {
         $this->query->setQueryCacheDriver($queryCache);
        return $this; }

    public function useQueryCache($bool)
    {
         $this->query->useQueryCache($bool);
        return $this; }

    public function getQueryCacheDriver()
    {
        return $this->query->getQueryCacheDriver();
    }

    public function setQueryCacheLifetime($timeToLive)
    {
        return $this->query->setQueryCacheLifetime($timeToLive);
        return $this; }

    public function getQueryCacheLifetime()
    {
        return $this->query->getQueryCacheLifetime();
    }

    public function expireQueryCache($expire = true)
    {
         $this->query->expireQueryCache($expire);
        return $this; }

    public function getExpireQueryCache()
    {
        return $this->query->getExpireQueryCache();
    }

    public function free()
    {
        $this->query->free();
    }

    public function setDQL($dqlQuery)
    {
         $this->query->setDQL($dqlQuery);
        return $this;   }

    public function getDQL()
    {
        return $this->query->getDQL();
    }

    public function getState()
    {
        return $this->query->getState();
    }

    public function contains($dql)
    {
        return $this->query->contains($dql);
    }

    public function setFirstResult($firstResult)
    {
        return $this->query->setFirstResult($firstResult);
        return $this; }

    public function getFirstResult()
    {
        return $this->query->getFirstResult();
    }

    public function setMaxResults($maxResults)
    {
        return $this->query->setMaxResults($maxResults);
        return $this;  }

    public function getMaxResults()
    {
        return $this->query->getMaxResults();
    }

    public function iterate($parameters = null, $hydrationMode = \Doctrine\ORM\Query::HYDRATE_OBJECT)
    {
        return $this->query->iterate($parameters, $hydrationMode);
    }

    public function setHint($name, $value)
    {
        return $this->query->setHint($name, $value);
        return $this; }

    public function setHydrationMode($hydrationMode)
    {
        return $this->query->setHydrationMode($hydrationMode);
        return $this; }

    public function setLockMode($lockMode)
    {
        return $this->query->setLockMode($lockMode);
        return $this; }

    public function getLockMode()
    {
        return $this->query->getLockMode();
    }

    /**
     * Executes the query and returns a the resulting Statement object.
     *
     * @return \Doctrine\DBAL\Driver\Statement The executed database statement that holds the results.
     */
    protected function _doExecute()
    {

        return $this->query->_doExecute();

    }
}