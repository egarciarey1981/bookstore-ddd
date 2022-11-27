<?php

declare(strict_types=1);

use App\Catalog\Domain\Model\Genre\GenreRepository;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use DI\ContainerBuilder;

return function (ContainerBuilder $containerBuilder) {
    // Here we map our UserRepository interface to its in memory implementation
    $containerBuilder->addDefinitions([
        GenreRepository::class => \DI\autowire(InMemoryGenreRepository::class),
    ]);
};