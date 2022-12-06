<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Delete\DeleteGenreRequest;
use App\Catalog\Application\Service\Genre\Delete\DeleteGenreService;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class DeleteGenreAction extends Action
{
    private DeleteGenreService $deleteGenreService;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->deleteGenreService = new DeleteGenreService($genreRepository);
    }

    public function action(): Response
    {
        $id = $this->args['id'];

        $deleteGenreRequest = new DeleteGenreRequest($id);

        $this->deleteGenreService->execute($deleteGenreRequest);

        return $this->respond();
    }
}
