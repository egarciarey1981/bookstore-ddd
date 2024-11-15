<?php

use App\Catalog\Domain\Model\Author\AuthorRepository;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryAuthorRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        AuthorRepository::class => \DI\autowire(InMemoryAuthorRepository::class),
    ]);
};
