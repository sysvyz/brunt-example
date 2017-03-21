<?php
namespace Svz\Entity;

// src/Product.php
use Svz\Entity\I\Entity;

class Product implements Entity
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var number
     */
    protected $price;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return number
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param number $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

  
}