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
        $deleteGenreService = new DeleteGenreService($this->genreRepository);

        $deleteGenreService->execute(
            new DeleteGenreRequest(
                $this->args['id']
            )
        );

        return $this->respond();
    }
}
