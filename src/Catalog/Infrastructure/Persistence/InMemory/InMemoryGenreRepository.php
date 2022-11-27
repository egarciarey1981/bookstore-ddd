<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Persistence\InMemory;

use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Domain\Model\Genre\GenreRepository;

class InMemoryGenreRepository implements GenreRepository
{
    /** @var array<Genre> */
    private array $genres;

    /** @param array<Genre> $genres*/
    public function __construct(array $genres = [])
    {
        if (empty($genres)) {
            $genres = $this->generateGenres();
        }

        $this->genres = $genres;
    }

    /** @return array<Genre> */
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

    public function remove(Genre $theGenre): void
    {
        foreach ($this->genres as $key => $genre) {
            if ($genre->equals($theGenre)) {
                unset($this->genres[$key]);
                return;
            }
        }

        throw new GenreNotFoundException();
    }

    public function all(): array
    {
        return $this->genres;
    }
}
