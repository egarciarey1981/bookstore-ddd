<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\Create\CreateGenreRequest;
use App\Catalog\Application\Service\Genre\Create\CreateGenreService;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CreateGenreServiceTest extends TestCase
{
    /**
     * @dataProvider dataProviderValidArguments
     */
    public function testCreate(string $name): void
    {
        $repository = new InMemoryGenreRepository();

        $service = new CreateGenreService($repository);
        $response = $service->execute(
            new CreateGenreRequest(
                $name
            )
        );

        $genreId = new GenreId($response->genre['id']);
        $genre = $repository->genreOfId($genreId);

        self::assertTrue($genre->id()->equals($genreId));
        self::assertTrue($genre->name()->equals(new GenreName($name)));
    }

    /**
     * @dataProvider dataProviderInvalidArguments
     */
    public function testInvalidArguments(string $name): void
    {
        $this->expectException(InvalidArgumentException::class);

        $service = new CreateGenreService(
            new InMemoryGenreRepository()
        );

        $service->execute(
            new CreateGenreRequest(
                $name
            )
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
