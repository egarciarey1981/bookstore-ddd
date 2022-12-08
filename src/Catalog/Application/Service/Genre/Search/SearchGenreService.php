<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Search;

use Bookstore\Catalog\Application\Service\Genre\GenreService;

class SearchGenreService extends GenreService
{
    public function execute(SearchGenreRequest $request): SearchGenreResponse
    {
        $genres = $this->genreRepository->all();

        $array = [];

        foreach ($genres as $genre) {
            $array[] = $genre->toArray();
        }

        return new SearchGenreResponse($array);
    }
}
