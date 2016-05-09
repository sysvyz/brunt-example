<?php
use Svz\App;

include "init.php";

$app = bootstrap(__DIR__)->{App::class};
echo '...app...';

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