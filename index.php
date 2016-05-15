<?php

use Composer\Autoload\ClassLoader;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Svz\App;

include "init.php";


echo 'before.bootstrap...'.PHP_EOL;
$app = bootstrap(__DIR__)->{App::class};

echo 'after.bootstrap...'.PHP_EOL;

/** @var App $app */
$app->run();

/*
CALL SEQUENCE:

index.php
    init.php
    get(App)
    app->run()
        dispather
        homecontroller
            service

 */