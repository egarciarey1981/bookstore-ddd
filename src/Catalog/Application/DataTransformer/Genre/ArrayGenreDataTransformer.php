<?php

declare(strict_types=1);

namespace App\Catalog\Application\DataTransformer\Genre;

use App\Catalog\Domain\Model\Genre\Genre;

class ArrayGenreDataTransformer implements GenreDataTransformer
{
    /** @var array<string,string> */
    private array $data;

    public function write(Genre $genre): void
    {
        $array = [];
        $array['id'] = $genre->genreId()->value();
        $array['name'] = $genre->genreName()->value();
        $this->data = $array;
    }

    public function read(): mixed
    {
        return $this->data;
    }
}
