<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Model\Genre;

class Genre
{
    private GenreId $id;
    private GenreName $name;

    public function __construct(GenreId $id, GenreName $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): GenreId
    {
        return $this->id;
    }

    public function name(): GenreName
    {
        return $this->name;
    }
}
