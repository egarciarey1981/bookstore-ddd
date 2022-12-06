<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\List\ListGenreRequest;
use App\Catalog\Application\Service\Genre\List\ListGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class ListGenreAction extends GenreAction
{
    public function action(): Response
    {
        $listGenreService = new ListGenreService($this->genreRepository);

        $listGenreResponse = $listGenreService->execute(
            new ListGenreRequest()
        );

        return $this->respondWithData([
            'genres' => $listGenreResponse->genres
        ]);
    }
}
