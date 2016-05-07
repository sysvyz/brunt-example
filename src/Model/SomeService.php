<?php
namespace Svz\Model;
use Brunt\InjectableInterface;

/**
 * Created by PhpStorm.
 * User: mb
 * Date: 07.05.16
 * Time: 16:26
 */
class SomeService
{
    /**
     * @var string
     */
    private $basePath;


    /**
     * SomeService constructor.
     */
    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
    }

    public function runSomeTask(){
        return 'done -> '.$this->basePath;
    }

    public static function _DI_DEPENDENCIES()
    {
       return ['basePath' => '%BASE_DIR%'];
    }
}