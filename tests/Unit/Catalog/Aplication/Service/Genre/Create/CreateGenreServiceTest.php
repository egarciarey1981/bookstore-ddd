<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\Create\CreateGenreRequest;
use App\Catalog\Application\Service\Genre\Create\CreateGenreService;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class CreateGenreServiceTest extends TestCase
{
    public function testHappyPath(): void
    {
        $genre = GenreObjectMother::createOne();

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
    public function dataProviderInvalidArguments(): array
    {
        return [
            [''],
            ['ab'],
            ['this genre name is too long'],
        ];
    }
}
