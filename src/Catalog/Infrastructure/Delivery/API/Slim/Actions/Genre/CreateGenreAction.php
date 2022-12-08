<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use Bookstore\Catalog\Application\Service\Genre\Create\CreateGenreRequest;
use Bookstore\Catalog\Application\Service\Genre\Create\CreateGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class CreateGenreAction extends GenreAction
{
    public function action(): Response
    {
        $createGenreService = new CreateGenreService(
            $this->genreRepository
        );

        $formData = $this->getFormData();

        $response = $createGenreService->execute(
            new CreateGenreRequest(
                $formData['name']
            )
        );

        $this->setHeader('Location', "/catalog/genre/{$response->genre['id']}");

        return $this->respond(201);
    }
}
