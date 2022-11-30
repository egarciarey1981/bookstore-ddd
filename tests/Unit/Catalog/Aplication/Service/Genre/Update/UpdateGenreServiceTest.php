<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use Exception;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\TestCase;

class UpdateGenreServiceTest extends TestCase
{
    public function testUpdate(): void
    {
        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';
        $genreId = new GenreId($id);

        $oldName = 'Terror';
        $newName = 'Adventure';

        $oldGenreName = new GenreName($oldName);
        $newGenreName = new GenreName($newName);

        $oldGenre = new Genre($genreId, $oldGenreName);
        $newGenre = new Genre($genreId, $newGenreName);

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn($oldGenre, $newGenre);
        $repository
            ->shouldReceive('save')
            ->andReturn(true)
            ->once();

        $service = new UpdateGenreService($repository);
        $response = $service->execute(
            new UpdateGenreRequest(
                $id,
                $newName
            )
        );

        $genre = $repository->genreOfId($genreId);

        self::assertEquals($newName, $response->genre['name']);
    }
    public function testNotUpdate(): void
    {
        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';
        $name = 'Terror';

        $genreId = new GenreId($id);
        $genreName = new GenreName($name);

        $genre = new Genre($genreId, $genreName);

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn($genre);
        $repository
            ->shouldReceive('save')
            ->andReturn(false)
            ->once();

        $this->expectException(Exception::class);

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest(
                $id,
                $name
            )
        );
    }

    public function testNotFind(): void
    {
        $this->expectException(GenreNotFoundException::class);

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn(null);

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest(
                'bd207a1c-fe19-4ed2-a61b-c315ca95d38c',
                'Adventure',
            )
        );
    }

    /**
     * @dataProvider dataProviderInvalidArguments
     */
    public function testInvalidArguments(string $id, string $name): void
    {
        $this->expectException(InvalidArgumentException::class);

        $service = new UpdateGenreService(
            Mockery::mock(GenreRepository::class)
        );

        $service->execute(
            new UpdateGenreRequest(
                $id,
                $name,
            )
        );
    }

    /**
     * @return array<array<string>>
     */
    public function dataProviderInvalidArguments(): array
    {
        return [
            ['invalid uuid', 'Adventure'],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', ''],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'ab'],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'this genre name is too long'],
        ];
    }
}
