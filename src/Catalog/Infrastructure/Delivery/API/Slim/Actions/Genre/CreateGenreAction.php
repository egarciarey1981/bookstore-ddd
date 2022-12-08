<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Create\Request;
use App\Catalog\Application\Service\Genre\Create\Service;
use Psr\Http\Message\ResponseInterface as Response;

class CreateGenreAction extends GenreAction
{
    public function action(): Response
    {
        $formData = $this->getFormData();

        $service = new Service($this->repository);

        $response = $service->execute(
            new Request($formData['name'])
        );

        $this->setHeader('Location', "/catalog/genre/{$response->genre['id']}");

        return $this->respond(201);
    }
}
