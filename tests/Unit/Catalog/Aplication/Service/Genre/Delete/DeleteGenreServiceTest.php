<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\List;

use App\Catalog\Application\Service\Genre\Delete\DeleteGenreRequest;
use App\Catalog\Application\Service\Genre\Delete\DeleteGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use PHPUnit\Framework\TestCase;

class DeleteGenreServiceTest extends TestCase
{
    public function testDelete(): void
    {
        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';

        $repository = new InMemoryGenreRepository();
        $repository->save(
            new Genre(
                new GenreId($id),
                new GenreName('Adventure'),
            )
        );

        $service = new DeleteGenreService($repository);
        $service->execute(
            new DeleteGenreRequest($id)
        );

        self::assertNull($repository->genreOfId(new GenreId($id)));
    }

    public function testNotFound(): void
    {
        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';

        $service = new DeleteGenreService(
            new InMemoryGenreRepository()
        );

        $this->expectException(GenreNotFoundException::class);

        $service->execute(
            new DeleteGenreRequest($id) 
        );
    }
}
