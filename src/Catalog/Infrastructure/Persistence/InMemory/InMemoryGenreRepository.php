<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Infrastructure\Persistence\InMemory;

use Bookstore\Catalog\Domain\Model\Genre\Genre;
use Bookstore\Catalog\Domain\Model\Genre\GenreId;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;
use Ramsey\Uuid\Uuid;

class InMemoryGenreRepository implements GenreRepository
{
    /** @var array<Genre> */
    private array $genres;

    public function nextIdentity(): GenreId
    {
        return new GenreId(strval(Uuid::uuid4()));
    }

    public function contains(Genre $genre): bool
    {
        return isset($this->genres[$genre->genreId()->value()]);
    }

    public function save(Genre $genre): void
    {
        $this->genres[$genre->genreId()->value()] = $genre;
    }

    public function genreOfId(GenreId $genreId): ?Genre
    {
        return $this->genres[$genreId->value()] ?? null;
    }

    public function remove(Genre $genre): void
    {
        unset($this->genres[$genre->genreId()->value()]);
    }

    public function all(): array
    {
        return $this->genres;
    }
}
