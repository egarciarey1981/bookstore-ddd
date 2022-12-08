<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Search;

use Bookstore\Catalog\Domain\Model\Genre\Genre;

class SearchGenreResponse
{
    /**
     * @var array<int,array<string>>
     */
    public array $genres = [];

    public function __construct(Genre ...$genres)
    {
        foreach ($genres as $genre) {
            $this->genres[] = $genre->toArray();
        }
    }
}
