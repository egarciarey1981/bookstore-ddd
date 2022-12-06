<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\DataTransformer\Genre\ArrayGenreDataTransformer;
use App\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use App\Catalog\Application\Service\Genre\View\ViewGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class ViewGenreAction extends GenreAction
{
    public function action(): Response
    {
        $viewGenreService = new ViewGenreService(
            $this->genreRepository,
            new ArrayGenreDataTransformer(),
        );

        $viewGenreService->execute(
            new ViewGenreRequest(
                $this->args['id'],
            )
        );

        return $this->respondWithData([
            'genre' => $viewGenreService->genreDataTransformer()->read()
        ]);
    }
}
