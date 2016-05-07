<?php
use Svz\App;

include "init.php";

bootstrap()->{App::class}->run();


/*
CALL SEQUENCE:

index.php
    init.php
    app->run()
        dispather
        homecontroller
            service

 */