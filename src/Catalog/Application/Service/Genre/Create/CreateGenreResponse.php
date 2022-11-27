<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

use App\Catalog\Domain\Model\Genre\Genre;

class CreateGenreResponse
{
    /** @var array<string> */
    public array $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = [
            'id' => strval($genre->id()),
            'name' => strval($genre->name()),
        ];
    }
}
