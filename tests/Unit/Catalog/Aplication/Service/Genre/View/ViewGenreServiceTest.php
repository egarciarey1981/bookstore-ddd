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
use PHPUnit\Framework\TestCase;

class ViewGenreServiceTest extends TestCase
{
    public function testFind(): void
    {
        $genres = [
            new Genre(
                GenreId::create(),
                new GenreName('One'),
            ),
            new Genre(
                GenreId::create(),
                new GenreName('Two'),
            ),
            new Genre(
                GenreId::create(),
                new GenreName('Three'),
            ),
        ];

        $genreRepository = new InMemoryGenreRepository();
        $genreRepository->saveAll(...$genres);

        shuffle($genres);
        $randGenre = $genres[0];

        $viewGenreService = new ViewGenreService($genreRepository);
        $viewGenreResponse = $viewGenreService->execute(
            new ViewGenreRequest(strval($randGenre->id()))
        );

        $genreFound = $viewGenreResponse->genre;

        self::assertEquals(strval($randGenre->id()), $genreFound['id']);
    }

    public function testNotFind(): void
    {
        $this->expectException(GenreNotFoundException::class);

        $viewGenreService = new ViewGenreService(
            new InMemoryGenreRepository()
        );

        $viewGenreService->execute(
            new ViewGenreRequest(strval(GenreId::create()))
        );
    }
}
