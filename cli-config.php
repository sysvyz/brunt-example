<?php
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;


include "init.php";


return ConsoleRunner::createHelperSet(
    bootstrap(__DIR__)->{EntityManager::class}
);