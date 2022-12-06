<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\Create\CreateGenreRequest;
use App\Catalog\Application\Service\Genre\Create\CreateGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CreateGenreServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderValidArguments
     */
    public function testHappyPath(string $id, string $name): void
    {
        $genre = new Genre(
            new GenreId($id),
            new GenreName($name),
        );

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('nextId')
            ->willReturn($genre->genreId());
        $repository
            ->expects($this->once())
            ->method('save')
            ->with($genre);

        $service = new CreateGenreService($repository);
        $service->execute(
            new CreateGenreRequest($genre->genreName()->value())
        );
    }

    /**
     * @dataProvider dataProviderInvalidArguments
     */
    public function testInvalidArguments(string $name): void
    {
        $service = new CreateGenreService(
            $this->createMock(GenreRepository::class)
        );

        $this->expectException(InvalidArgumentException::class);

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
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'abc'],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'aaaaabbbbbcccccddddd'],
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
