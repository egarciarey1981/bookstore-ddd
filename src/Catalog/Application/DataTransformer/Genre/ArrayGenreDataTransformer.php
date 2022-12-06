<?php

declare(strict_types=1);

namespace App\Catalog\Application\DataTransformer\Genre;

use App\Catalog\Domain\Model\Genre\Genre;

class ArrayGenreDataTransformer implements GenreDataTransformer{

    private array $data;

    public function write(Genre $genre): void
    {
        $this->data['genre'] = [];
        $this->data['genre']['id'] = $genre->genreId()->value();
        $this->data['genre']['name'] = $genre->genreName()->value();
    }

    public function read(): mixed{
        return $this->data;
    }
}