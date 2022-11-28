<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Persistence\InMemory;

use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreRepository;

class InMemoryGenreRepository implements GenreRepository
{
    /** @var array<Genre> */
    private array $genres;

    public function __construct()
    {
        $genres = [
            new Genre(
                new GenreId('50df20ba-cb69-4184-b851-cce89e01e419'),
                new GenreName('Terror'),
            ),
            new Genre(
                new GenreId('bd207a1c-fe19-4ed2-a61b-c315ca95d38c'),
                new GenreName('Adventure'),
            ),
        ];

        $this->saveAll(...$genres);
    }

    public function nextIdentity(): GenreId
    {
        return GenreId::create();
    }

    public function save(Genre $genre): void
    {
        $this->genres[strval($genre->id())] = $genre;
    }

    public function saveAll(Genre ...$genres): void
    {
        foreach ($genres as $genre) {
            $this->save($genre);
        }
    }

    public function genreOfId(GenreId $id): ?Genre
    {
        if (!isset($this->genres[strval($id)])) {
            return null;
        }

        return $this->genres[strval($id)];
    }

    public function remove(Genre $genre): void
    {
        unset($this->genres[strval($genre->id())]);
    }

    public function all(): array
    {
        return $this->genres;
    }
}
