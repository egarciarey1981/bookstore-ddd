<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\List;

use App\Catalog\Domain\Model\Genre\Genre;

class ListGenreResponse
{
    public array $genres = [];

    public function __construct(Genre ...$genres)
    {
        foreach ($genres as $genre) {
            $this->genres[] = [
                'id' => strval($genre->id()),
                'name' => strval($genre->name()),
            ];
        }
    }
}
