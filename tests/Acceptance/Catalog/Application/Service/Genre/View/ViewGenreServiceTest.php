<?php

declare(strict_types=1);

namespace Tests\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use App\Catalog\Application\Service\Genre\View\ViewGenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class ViewGenreServiceTest extends TestCase
{
    public function testHappyPath(): void
    {
        $id = '50df20ba-cb69-4184-b851-cce89e01e400';
        $name = 'Pirates';

        $repository = new InMemoryGenreRepository();
        $repository->save(
            new Genre(
                new GenreId($id),
                new GenreName($name),
            )
        );

        $service = new ViewGenreService($repository);
        $response = $service->execute(
            new ViewGenreRequest($id)
        );

        $genre = $response->genre;

        assertEquals($id, $genre['id']);
        assertEquals($name, $genre['name']);
    }

    public function testNotFound(): void
    {
        $this->expectException(GenreNotFoundException::class);

        $service = new ViewGenreService(
            new InMemoryGenreRepository()
        );

        $service->execute(
            new ViewGenreRequest('50df20ba-cb69-4184-b851-cce89e01e400')
        );
    }
}
