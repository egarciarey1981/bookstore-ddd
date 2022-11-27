<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Model\Genre;

interface GenreRepository
{
    public function nextIdentity(): GenreId;
    public function add(Genre $genre): void;
    public function ofId(GenreId $id): ?Genre;
    public function remove(Genre $genre): void;
    /**
     * @return array<Genre>
     */
    public function all(): array;
}
