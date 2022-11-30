<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\Create\CreateGenreRequest;
use App\Catalog\Application\Service\Genre\Create\CreateGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use Exception;
use InvalidArgumentException;
use Mockery;
use PHPUnit\Framework\TestCase;

class CreateGenreServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderValidArguments
     */
    public function testCreate(string $name): void
    {
        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';

        $genreId = new GenreId($id);
        $genreName = new GenreName($name);

        $genre = new Genre(
            $genreId,
            $genreName,
        );

        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('save')
            ->andReturn(true);
        $repository
            ->shouldReceive('nextIdentity')
            ->andReturn($genreId);
        $repository
            ->shouldReceive('genreOfId')
            ->andReturn($genre);

        $service = new CreateGenreService($repository);
        $response = $service->execute(
            new CreateGenreRequest($name)
        );

        self::assertEquals($id, $response->genre['id']);
        self::assertEquals($name, $response->genre['name']);
    }

    public function testNotCreate(): void
    {
        $repository = Mockery::mock(GenreRepository::class);
        $repository
            ->shouldReceive('save')
            ->andReturn(false);
        $repository
            ->shouldReceive('nextIdentity')
            ->andReturn(new GenreId('bd207a1c-fe19-4ed2-a61b-c315ca95d38c'));

        $this->expectException(Exception::class);

        $service = new CreateGenreService($repository);
        $service->execute(
            new CreateGenreRequest('Adventure')
        );
    }

    /**
     * @dataProvider dataProviderInvalidArguments
     */
    public function testInvalidArguments(string $name): void
    {
        $this->expectException(InvalidArgumentException::class);

        $service = new CreateGenreService(
            Mockery::mock(GenreRepository::class)
        );

        $service->execute(
            new CreateGenreRequest($name)
        );
    }

    /**
     * @return array<array<string>>
     */
    public function dataProviderValidArguments(): array
    {
        return [
            ['Foo'],
            ['Adventure'],
            ["this isn't too large"],
        ];
    }

    /**
     * @return array<array<string>>
     */
    public function dataProviderInvalidArguments(): array
    {
        return [
            [''],
            ['ab'],
            ['this genre name is too long'],
        ];
    }
}
