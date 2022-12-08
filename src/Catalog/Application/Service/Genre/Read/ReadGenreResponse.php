<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Read;

use Bookstore\Catalog\Domain\Model\Genre\Genre;

class ReadGenreResponse
{
    /**
     * @var array<string>
     */
    public array $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre->toArray();
    }
}
