<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\List\Request;
use App\Catalog\Application\Service\Genre\List\Service;
use Psr\Http\Message\ResponseInterface as Response;

class ListGenreAction extends GenreAction
{
    public function action(): Response
    {
        $service = new Service($this->repository);

        $response = $service->execute(
            new Request()
        );

        return $this->respondWithData(['genres' => $response->genres]);
    }
}
