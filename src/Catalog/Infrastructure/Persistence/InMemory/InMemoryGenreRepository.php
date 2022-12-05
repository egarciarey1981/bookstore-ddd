<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Persistence\InMemory;

use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use Ramsey\Uuid\Uuid;

class InMemoryGenreRepository implements GenreRepository
{
    /** @var array<Genre> */
    private array $genres;

    public function nextId(): GenreId
    {
        return new GenreId(strval(Uuid::uuid4()));
    }

    public function save(Genre $genre): bool
    {
        $this->genres[strval($genre->id())] = $genre;
        return true;
    }

    public function ofId(GenreId $id): ?Genre
    {
        if (!isset($this->genres[strval($id)])) {
            return null;
        }

        return $this->genres[strval($id)];
    }

    public function remove(Genre $genre): bool
    {
        unset($this->genres[strval($genre->id())]);
        return true;
    }

    public function all(): array
    {
        return $this->genres;
    }
}
