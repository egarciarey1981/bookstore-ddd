<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Model\Genre;

interface GenreRepository
{
    public function nextId(): GenreId;
    public function ofId(GenreId $id): ?Genre;
    public function contains(Genre $genre): bool;
    public function save(Genre $genre): bool;
    public function remove(Genre $genre): bool;
    /**
     * @return array<Genre>
     */
    public function all(): array;
}
