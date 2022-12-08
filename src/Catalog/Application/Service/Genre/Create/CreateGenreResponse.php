<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Create;

use Bookstore\Catalog\Domain\Model\Genre\Genre;

class CreateGenreResponse
{
    public array $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre->toArray();
    }
}
