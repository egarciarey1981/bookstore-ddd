<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Persistence\InMemory;

use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreRepository;

class InMemoryGenreRepository implements GenreRepository
{
    private array $genres;

    public function __construct(array $genres = [])
    {
        if (empty($genres)) {
            $genres = $this->generateGenres();
        }

        $this->genres = $genres;
    }

    private function generateGenres(): array
    {
        return [
            new Genre(
                new GenreId('50df20ba-cb69-4184-b851-cce89e01e419'),
                new GenreName('Terror'),
            ),
            new Genre(
                new GenreId('bd207a1c-fe19-4ed2-a61b-c315ca95d38c'),
                new GenreName('Comedy'),
            ),
        ];
    }

    public function add(Genre $genre): void
    {
        $this->genres[] = $genre;
    }

    public function ofId(GenreId $id): ?Genre
    {
        foreach ($this->genres as $genre) {
            if ($genre->id()->equals($id)) {
                return $genre;
            }
        }

        return null;
    }

    public function all(): array
    {
        return $this->genres;
    }
}
