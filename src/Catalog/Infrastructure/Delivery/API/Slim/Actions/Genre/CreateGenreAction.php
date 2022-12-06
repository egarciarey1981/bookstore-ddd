<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Create\CreateGenreRequest;
use App\Catalog\Application\Service\Genre\Create\CreateGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class CreateGenreAction extends GenreAction
{
    public function action(): Response
    {
        $formData = $this->getFormData();

        $createGenreService = new CreateGenreService($this->genreRepository);

        $createGenreResponse = $createGenreService->execute(
            new CreateGenreRequest(
                $formData['name'],
            )
        );

        $this->setHeader('Location', '/catalog/genre/' . $createGenreResponse->id);

        return $this->respond(201);
    }
}
