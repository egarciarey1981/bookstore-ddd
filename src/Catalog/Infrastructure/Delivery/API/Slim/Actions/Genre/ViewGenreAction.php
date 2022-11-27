<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use App\Catalog\Application\Service\Genre\View\ViewGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class ViewGenreAction extends GenreAction
{
    public function action(): Response
    {
        $id = $this->args['id'];

        $viewGenreRequest = new ViewGenreRequest($id);
        $viewGenreService = new ViewGenreService($this->genreRepository);
        $viewGenreResponse = $viewGenreService->execute($viewGenreRequest);

        $genre = $viewGenreResponse->genre;

        $data = ['genre' => $genre];

        return $this->respondWithData($data);
    }
}
