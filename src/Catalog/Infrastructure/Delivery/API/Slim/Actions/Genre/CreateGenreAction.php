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

        $createGenreRequest = new CreateGenreRequest($formData['name']);
        $createGenreService = new CreateGenreService($this->genreRepository);
        $createGenreResponse = $createGenreService->execute($createGenreRequest);

        $genre = $createGenreResponse->genre;

        $this->setHeader('Location', '/genre/' . $genre['id']);

        $data = ['genre' => $genre];

        return $this->respondWithData($data, 201);
    }
}
