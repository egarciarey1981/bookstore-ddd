<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\View;

use App\Catalog\Domain\Model\Genre\Genre;

class ViewGenreResponse
{
    /** @var array<string> */
    public array $genre;

    public function __construct(Genre $genre)
    {
        $array = [];
        $array['id'] = strval($genre->id());
        $array['name'] = strval($genre->name());
        $this->genre = $array;
    }
}
