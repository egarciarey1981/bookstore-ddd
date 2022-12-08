<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\View\Request;
use App\Catalog\Application\Service\Genre\View\Service;
use Psr\Http\Message\ResponseInterface as Response;

class ViewGenreAction extends GenreAction
{
    public function action(): Response
    {
        $service = new Service($this->repository);

        $response = $service->execute(
            new Request($this->args['id'])
        );

        return $this->respondWithData(['genre' => $response->genre]);
    }
}
