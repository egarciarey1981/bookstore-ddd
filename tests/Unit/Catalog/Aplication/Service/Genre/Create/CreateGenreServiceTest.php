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
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class CreateGenreServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderValidArguments
     */
    public function testCreate(string $id, string $name): void
    {
        $genre = new Genre(
            new GenreId($id),
            new GenreName($name),
        );

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('nextIdentity')
            ->willReturn($genre->id());
        $repository
            ->expects($this->once())
            ->method('save')
            ->with($genre)
            ->willReturn(true);

        $service = new CreateGenreService($repository);
        $response = $service->execute(
            new CreateGenreRequest($name)
        );
    }

    public function testNotCreate(): void
    {
        $genre = GenreObjectMother::createOne();

        $repository = $this->createMock(GenreRepository::class);
        $repository
            ->expects($this->once())
            ->method('nextIdentity')
            ->willReturn($genre->id());
        $repository
            ->expects($this->once())
            ->method('save')
            ->with($genre)
            ->willReturn(false);

        $this->expectException(Exception::class);

        $service = new CreateGenreService($repository);
        $service->execute(
            new CreateGenreRequest(strval($genre->name()))
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
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c' ,'Foo'],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', 'Adventure'],
            ['bd207a1c-fe19-4ed2-a61b-c315ca95d38c', "this isn't too large"],
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
