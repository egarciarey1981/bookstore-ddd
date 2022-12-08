<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use Bookstore\Catalog\Application\Service\Genre\Search\SearchGenreRequest;
use Bookstore\Catalog\Application\Service\Genre\Search\SearchGenreService;
use Psr\Http\Message\ResponseInterface as Response;

class SearchGenreAction extends GenreAction
{
    public function action(): Response
    {
        //$formData = $this->getFormData();

        $service = new SearchGenreService($this->repository);

        $response = $service->execute(
            new SearchGenreRequest(
                //order, filter, limit, offset...
            )
        );

        return $this->respondWithData(['genres' => $response->genres]);
    }
}
