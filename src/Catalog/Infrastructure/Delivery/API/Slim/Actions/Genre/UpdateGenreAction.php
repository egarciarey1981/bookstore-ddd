<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Update\UpdateGenreService;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateGenreAction extends GenreAction
{
    public function action(): Response
    {
        $id = $this->args['id'];
        $formData = $this->getFormData();

        $updateGenreRequest = new UpdateGenreRequest($id, $formData['name']);
        $updateGenreService = new UpdateGenreService($this->genreRepository);
        $updateGenreResponse = $updateGenreService->execute($updateGenreRequest);

        $genre = $updateGenreResponse->genre;

        $data = ['genre' => $genre];

        return $this->respondWithData($data, 201);
    }
}
