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
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class UpdateGenreServiceTest extends TestCase
{
    public function testHappyPath(): void
    {
        $genreId = new GenreId('bd207a1c-fe19-4ed2-a61b-c315ca95d38c');

        $genreOld = new Genre(
            $genreId,
            new GenreName('Adventure'),
        );

        $genreNew = new Genre(
            $genreId,
            new GenreName('Pirates'),
        );

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genreId)
            ->willReturn($genreOld);
        $repository
            ->expects($this->once())
            ->method('save')
            ->with($genreNew);

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest(
                $genreNew->genreId()->value(),
                $genreNew->genreName()->value(),
            )
        );
    }

    public function testNotFound(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->genreId())
            ->willReturn(null);

        $this->expectException(GenreNotFoundException::class);

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest(
                $genre->genreId()->value(),
                $genre->genreName()->value(),
            )
        );
    }

    /**
     * @dataProvider dataProviderInvalidArguments
     */
    public function testInvalidArguments(string $id, string $name): void
    {
        $genre = GenreObjectMother::createOne();
        
        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with(new GenreId($id))
            ->willReturn($genre);

        $this->expectException(InvalidArgumentException::class);

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest($id, $name)
        );
    }

    /**
     * @return array<array<string>>
     */
    public function dataProviderInvalidArguments(): array
    {
        return [
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', ''],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'ab'],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'this genre name is too long'],
        ];
    }
}
