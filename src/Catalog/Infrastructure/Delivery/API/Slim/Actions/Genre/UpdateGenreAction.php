<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use Bookstore\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use Bookstore\Catalog\Application\Service\Genre\Update\UpdateGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateGenreAction extends GenreAction
{
    public function action(): Response
    {
        $updateGenreService = new UpdateGenreService(
            $this->genreRepository
        );

        $formData = $this->getFormData();

        $updateGenreService->execute(
            new UpdateGenreRequest(
                $this->args['id'],
                $formData['name'],
            )
        );

        return $this->respond();
    }
}
