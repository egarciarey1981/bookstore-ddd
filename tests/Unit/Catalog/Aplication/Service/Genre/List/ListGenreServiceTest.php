<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\List;

use App\Catalog\Application\Service\Genre\List\ListGenreRequest;
use App\Catalog\Application\Service\Genre\List\ListGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use PHPUnit\Framework\TestCase;

class ListGenreServiceTest extends TestCase
{
    public function testList(): void
    {
        $repository = new InMemoryGenreRepository();

        $genres = [
            new Genre(
                $repository->nextIdentity(),
                new GenreName('Adventure'),
            ),
            new Genre(
                $repository->nextIdentity(),
                new GenreName('Terror'),
            ),
        ];

        $repository->saveAll(...$genres);

        $service = new ListGenreService($repository);

        $response = $service->execute(
            new ListGenreRequest()
        );

        self::assertEquals(count($genres), count($response->genres));
    }
}
