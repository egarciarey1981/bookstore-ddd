<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\List;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Application\Service\Genre\List\ListGenreResponse as Response;
use App\Catalog\Application\Service\Genre\List\ListGenreRequest as Request;

class ListGenreService extends GenreService
{
    public function execute(Request $request): Response
    {
        $genres = $this->repository->all();

        return new Response(...$genres);
    }
}
