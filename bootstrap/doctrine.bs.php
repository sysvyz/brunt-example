<?php
use Brunt\Injector;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use function Brunt\bind;

const DI_DOCTRINE_CONFIG = 'Doctrine\ORM\Configuration';
;
const DI_DOCTRINE_CONFIG_PATH = "%DOCTRINE:CONFIG:PATH%";
const DI_DOCTRINE_DB_PARAMS = "%DOCTRINE:DB:PARAMS";
const DI_DB_CONFIG_PATH = "%ENV:DB:CONFIG:PATH%";

/**
 * @param Injector $injector
 */
return [

    bind(DI_DB_CONFIG_PATH)
        ->toFactory(function (Injector $injector) {
            return $injector->{DI_BASE_DIR} . "/config/database.php";
        })
        ->singleton(),

    bind(DI_DOCTRINE_CONFIG_PATH)
        ->toFactory(function (Injector $injector) {
            return [$injector->{DI_BASE_DIR} . "/config/xml/orm"];
        })
        ->singleton(),

    bind(DI_DOCTRINE_DB_PARAMS)
        ->toFactory(function (Injector $injector) {
            /** @noinspection PhpIncludeInspection */
            return include($injector->{DI_DB_CONFIG_PATH});
        })
        ->singleton(),

    bind(DI_DOCTRINE_CONFIG)
        ->toFactory(function (Injector $injector) {
            return Setup::createXMLMetadataConfiguration(
                $injector->get(DI_DOCTRINE_CONFIG_PATH),
                $injector->get(DI_DEV_MODE)
            );
        })
        ->lazy()
        ->singleton(),
    bind(EntityManager::class)
        ->toFactory(function (Injector $injector) {
            return EntityManager::create(
                $injector->get(DI_DOCTRINE_DB_PARAMS),
                $injector->get(DI_DOCTRINE_CONFIG)
            );
        }),


];
