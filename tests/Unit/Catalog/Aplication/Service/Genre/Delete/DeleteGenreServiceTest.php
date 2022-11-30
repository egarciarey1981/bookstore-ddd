<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\List;

use App\Catalog\Application\Service\Genre\Delete\DeleteGenreRequest;
use App\Catalog\Application\Service\Genre\Delete\DeleteGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\TestCase;

class DeleteGenreServiceTest extends TestCase
{
    public function testDelete(): void
    {
        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';
        $genreId = new GenreId($id);

        $genre = new Genre(
            $genreId,
            new GenreName('Adventure'),
        );

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn($genre, null);
        $repository
            ->shouldReceive('remove')
            ->andReturn(null);

        $service = new DeleteGenreService($repository);
        $service->execute(
            new DeleteGenreRequest($id)
        );

        self::assertNull($repository->genreOfId($genreId));
    }

    public function testNotFound(): void
    {
        $this->expectException(GenreNotFoundException::class);

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn(null);
        
        $service = new DeleteGenreService($repository);
        $service->execute(
            new DeleteGenreRequest('bd207a1c-fe19-4ed2-a61b-c315ca95d38c')
        );
    }

    public function testInvalidArgument(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $service = new DeleteGenreService(
            Mockery::mock(GenreRepository::class)
        );

        $service->execute(
            new DeleteGenreRequest('invalid uuid')
        );
    }
}
