<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Search;

class SearchGenreResponse
{
    /**
     * @var array<int,array<string>>
     */
    public array $genres = [];

    /**
     * @param array<int,array<string>> $genres
     */
    public function __construct(array $genres)
    {
        $this->genres = $genres;
    }
}
