<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

use App\Catalog\Domain\Model\Genre\Genre;

class CreateGenreResponse
{
    /** @var array<string> */
    public array $genre = [];

    public function __construct(Genre $genre)
    {
        $this->genre['id'] = $genre->genreId()->value();
        $this->genre['name'] = $genre->genreName()->value();
    }
}
