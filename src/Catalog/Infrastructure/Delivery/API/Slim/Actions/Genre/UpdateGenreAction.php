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
        $formData = $this->getFormData();

        $updateGenreService = new UpdateGenreService($this->genreRepository);

        $updateGenreService->execute(
            new UpdateGenreRequest(
                $this->args['id'],
                $formData['name'],
            )
        );

        return $this->respond(200);
    }
}
