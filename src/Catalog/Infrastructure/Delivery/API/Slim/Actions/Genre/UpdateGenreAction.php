<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Update\UpdateGenreService as Service;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest as Request;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateGenreAction extends GenreAction
{
    public function action(): Response
    {
        $formData = $this->getFormData();

        $service = new Service($this->repository);

        $service->execute(
            new Request(
                $this->args['id'],
                $formData['name'],
            )
        );

        return $this->respond();
    }
}
