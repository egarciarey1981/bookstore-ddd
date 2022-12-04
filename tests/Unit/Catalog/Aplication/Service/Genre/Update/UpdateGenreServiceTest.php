<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreService;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class UpdateGenreServiceTest extends TestCase
{
    public function testUpdate(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->id())
            ->willReturn($genre);
        $repository
            ->expects($this->once())
            ->method('save')
            ->with($genre)
            ->willReturn(true);

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest(
                strval($genre->id()),
                strval($genre->name()),
            )
        );
    }

    public function testNotUpdate(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('ofId')
            ->with($genre->id())
            ->willReturn($genre);
        $repository
            ->expects($this->once())
            ->method('save')
            ->with($genre)
            ->willReturn(false);

        $this->expectException(Exception::class);

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest(
                strval($genre->id()),
                strval($genre->name()),
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
            ->with($genre->id())
            ->willReturn(null);

        $this->expectException(GenreNotFoundException::class);

        $service = new UpdateGenreService($repository);
        $service->execute(
            new UpdateGenreRequest(
                strval($genre->id()),
                strval($genre->name()),
            )
        );
    }

    /**
     * @dataProvider dataProviderInvalidArguments
     */
    public function testInvalidArguments(string $id, string $name): void
    {
        $service = new UpdateGenreService(
            $this->createMock(GenreRepository::class)
        );

        $this->expectException(InvalidArgumentException::class);

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
            ['invalid uuid', 'Adventure'],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', ''],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'ab'],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'this genre name is too long'],
        ];
    }
}
