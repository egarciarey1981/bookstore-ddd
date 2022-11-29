<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use PHPUnit\Framework\TestCase;

class UpdateGenreServiceTest extends TestCase
{
    public function testUpdate(): void
    {
        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';
        $name = 'Terror';

        $repository = new InMemoryGenreRepository();
        $repository->save(
            new Genre(
                new GenreId($id),
                new GenreName('Adventure'),
            )
        );

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest(
                $id,
                $name
            )
        );

        $genre = $repository->genreOfId(new GenreId($id));

        self::assertTrue($genre->name()->equals(new GenreName($name)));
    }

    public function testNotFind(): void
    {
        $this->expectException(GenreNotFoundException::class);

        $service = new UpdateGenreService(
            new InMemoryGenreRepository()
        );

        $service->execute(
            new UpdateGenreRequest(
                'bd207a1c-fe19-4ed2-a61b-c315ca95d38c',
                'Adventure',
            )
        );
    }
}
