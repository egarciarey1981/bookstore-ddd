<?php

declare(strict_types=1);

use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;
use Bookstore\Catalog\Infrastructure\Persistence\Doctrine\DoctrineGenreRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        GenreRepository::class => \DI\autowire(DoctrineGenreRepository::class),
    ]);
};
