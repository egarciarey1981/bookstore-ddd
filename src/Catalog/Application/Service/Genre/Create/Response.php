<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

use App\Catalog\Domain\Model\Genre\Genre;

class Response
{
    public array $genre;

    public function __construct(Genre $genre) {
        $this->genre = $genre->toArray();
    }
}
