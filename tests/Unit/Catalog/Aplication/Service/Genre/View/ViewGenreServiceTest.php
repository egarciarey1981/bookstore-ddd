<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use App\Catalog\Application\Service\Genre\View\ViewGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\TestCase;

class ViewGenreServiceTest extends TestCase
{
    public function testFind(): void
    {

        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';
        $name = 'Adventure';

        $genreId = new GenreId($id);
        $genreName = new GenreName($name);

        $genre = new Genre(
            $genreId,
            $genreName,
        );

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn($genre);

        $service = new ViewGenreService($repository);
        $response = $service->execute(
            new ViewGenreRequest($id)
        );

        self::assertEquals($id, $response->genre['id']);
        self::assertEquals($name, $response->genre['name']);
    }

    public function testNotFind(): void
    {
        $this->expectException(GenreNotFoundException::class);

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn(null);
      
        $service = new ViewGenreService($repository);

        $service->execute(
            new ViewGenreRequest('bd207a1c-fe19-4ed2-a61b-c315ca95d38c')
        );
    }

    public function testMessageException(): void
    {
        $message = '';

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn(null);

        $service = new ViewGenreService($repository);

        try {
            $service->execute(
                new ViewGenreRequest('bd207a1c-fe19-4ed2-a61b-c315ca95d38c')
            );
        } catch (GenreNotFoundException $e) {
            $message = $e->getMessage();
        }


        self::assertEquals('Genre not found', $message);
    }

    public function testInvalidUuid(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $service = new ViewGenreService(
            Mockery::mock(GenreRepository::class)
        );

        $service->execute(
            new ViewGenreRequest('invalid uuid')
        );
    }
}
