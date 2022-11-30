<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\List;

use App\Catalog\Application\Service\Genre\List\ListGenreRequest;
use App\Catalog\Application\Service\Genre\List\ListGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use Mockery;
use PHPUnit\Framework\TestCase;

class ListGenreServiceTest extends TestCase
{
    public function testList(): void
    {
        $genres = [
            new Genre(
                new GenreId('bd207a1c-fe19-4ed2-a61b-c315ca95d38c'),
                new GenreName('Adventure'),
            ),
            new Genre(
                new GenreId('4bb90256-ef42-46d8-b4c2-c7d3a0f09299'),
                new GenreName('Terror'),
            ),
        ];

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('all')
            ->andReturn($genres);

        $service = new ListGenreService($repository);
        $response = $service->execute(
            new ListGenreRequest()
        );

        self::assertEquals(count($genres), count($response->genres));
    }
}
