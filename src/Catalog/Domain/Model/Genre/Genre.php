<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Model\Genre;

class Genre
{
    private GenreId $genreId;
    private GenreName $genreName;

    public function __construct(
        GenreId $genreId,
        GenreName $genreName,
    ) {
        $this->genreId = $genreId;
        $this->genreName = $genreName;
    }

    public function genreId(): GenreId
    {
        return $this->genreId;
    }

    public function setGenreName(GenreName $genreName): void
    {
        $this->genreName = $genreName;
    }

    public function genreName(): GenreName
    {
        return $this->genreName;
    }

    public function equals(Genre $genre): bool
    {
        return $this->genreId->equals($genre->genreId);
    }

    public function toArray(): array{
        $array['id'] = $this->genreId->value();
        $array['name'] = $this->genreName->value();
        return $array;
    }
}
