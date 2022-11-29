<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use App\Catalog\Application\Service\Genre\View\ViewGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ViewGenreServiceTest extends TestCase
{
    public function testFind(): void
    {
        $id = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';

        $repository = new InMemoryGenreRepository();
        $repository->save(
            new Genre(
                new GenreId($id),
                new GenreName('Adventure'),
            )
        );

        $service = new ViewGenreService($repository);
        $response = $service->execute(
            new ViewGenreRequest($id)
        );

        self::assertEquals($id, $response->genre['id']);
    }

    public function testNotFind(): void
    {
        $this->expectException(GenreNotFoundException::class);

        $service = new ViewGenreService(
            new InMemoryGenreRepository()
        );

        $service->execute(
            new ViewGenreRequest('bd207a1c-fe19-4ed2-a61b-c315ca95d38c')
        );
    }

    public function testMessageException(): void
    {
        $message = '';

        $service = new ViewGenreService(
            new InMemoryGenreRepository()
        );

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
            new InMemoryGenreRepository()
        );

        $service->execute(
            new ViewGenreRequest('invalid uuid')
        );
    }
}
