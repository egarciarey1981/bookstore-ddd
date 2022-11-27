<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\List;

use App\Catalog\Application\Service\Genre\GenreService;

class ListGenreService extends GenreService
{
    public function execute(ListGenreRequest $request): ListGenreResponse
    {
        $genres = $this->genreRepository->all();

        return new ListGenreResponse(...$genres);
    }
}
