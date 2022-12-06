<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Update;

use App\Catalog\Domain\Model\Genre\Genre;

class UpdateGenreResponse
{
    /** @var array<string> */
    public array $genre = [];

    public function __construct(Genre $genre)
    {
        $this->genre['id'] = strval($genre->genreId()->value());
        $this->genre['name'] = strval($genre->genreName()->value());
    }
}
