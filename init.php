<?php
require_once 'vendor/sysvyz/brunt/src/Binding.php';
use Brunt\Binding;
use Brunt\Injector;

use function Brunt\bind;

const APP_PATH = '/testproject';
const DEV_MODE = true;


const DI_APP_PATH = '%ENV_APP_PATH%';
const DI_BASE_DIR = "%ENV_BASE_DIR%";
const DI_DEV_MODE = "%DEV%";


function bootstrap()
{
    require_once __DIR__ . '/vendor/autoload.php';

    $injector = new Injector();

    $injector->bind(
        bind(DI_BASE_DIR)->toValue(__DIR__),
        bind(DI_APP_PATH)->toValue(APP_PATH),
        bind(DI_DEV_MODE)->toValue(DEV_MODE)
    );
    load_binding($injector, '/bootstrap/brunt.bs.php');
    load_binding($injector, '/bootstrap/doctrine.bs.php');
    load_binding($injector, '/bootstrap/klein.bs.php');
   
    return $injector;
}
function load_binding(Injector $injector,string $path){
    $injector->bind(include __DIR__. $path);
}