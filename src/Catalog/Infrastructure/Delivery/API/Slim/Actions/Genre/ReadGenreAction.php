<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use Bookstore\Catalog\Application\Service\Genre\Read\ReadGenreRequest;
use Bookstore\Catalog\Application\Service\Genre\Read\ReadGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class ReadGenreAction extends GenreAction
{
    public function action(): Response
    {
        $readGenreService = new ReadGenreService(
            $this->genreRepository
        );

        $response = $readGenreService->execute(
            new ReadGenreRequest(
                $this->args['id']
            )
        );

        return $this->respondWithData([
            'genre' => $response->genre
        ]);
    }
}
