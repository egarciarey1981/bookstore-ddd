<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Domain\Model\Genre;

interface GenreRepository
{
    public function nextIdentity(): GenreId;
    public function genreOfId(GenreId $id): ?Genre;
    public function contains(Genre $genre): bool;
    public function save(Genre $genre): void;
    public function remove(Genre $genre): void;
    /**
     * @return array<Genre>
     */
    public function all(): array;
}
