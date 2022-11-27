<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Delete\DeleteGenreRequest;
use App\Catalog\Application\Service\Genre\Delete\DeleteGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteGenreAction extends GenreAction
{
    public function action(): Response
    {
        $id = $this->args['id'];

        $deleteGenreRequest = new DeleteGenreRequest($id);
        $deleteGenreService = new DeleteGenreService($this->genreRepository);
        $deleteGenreResponse = $deleteGenreService->execute($deleteGenreRequest);

        return $this->respond();
    }
}
