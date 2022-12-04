<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Psr\Container\ContainerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        EntityManager::class => function (ContainerInterface $c) {
            Type::addType(
                'GenreId',
                'App\Catalog\Infrastructure\Persistence\Doctrine\Types\Genre\GenreIdType'
            );

            Type::addType(
                'GenreName',
                'App\Catalog\Infrastructure\Persistence\Doctrine\Types\Genre\GenreNameType'
            );

            return EntityManager::create(
                [
                    'driver' => 'pdo_mysql',
                    'host' => '192.168.112.3',
                    'port' => 3306,
                    'dbname' => 'bookstore',
                    'user' => 'root',
                    'password' => 'root',
                    'charset' => 'utf8'
                ],
                ORMSetup::createXMLMetadataConfiguration(
                    ['../src/Catalog/Infrastructure/Persistence/Doctrine/Mapping'],
                    $devMode = true
                )
            );
        },
    ]);
};
