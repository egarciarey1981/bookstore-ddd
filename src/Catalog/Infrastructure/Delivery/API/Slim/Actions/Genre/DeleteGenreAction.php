<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Delete\DeleteGenreRequest as Request;
use App\Catalog\Application\Service\Genre\Delete\DeleteGenreService as Service;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteGenreAction extends GenreAction
{
    public function action(): Response
    {
        $service = new Service($this->repository);

        $service->execute(
            new Request($this->args['id'])
        );

        return $this->respond();
    }
}
