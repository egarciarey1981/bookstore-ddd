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
        $service = new ReadGenreService($this->repository);

        $response = $service->execute(
            new ReadGenreRequest($this->args['id'])
        );

        if ([] === $response->genre) {
            return $this->respond(404);
        }

        return $this->respondWithData(['genre' => $response->genre]);
    }
}
