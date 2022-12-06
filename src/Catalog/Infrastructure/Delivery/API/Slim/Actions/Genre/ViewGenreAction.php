<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\DataTransformer\Genre\ArrayGenreDataTransformer;
use App\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use App\Catalog\Application\Service\Genre\View\ViewGenreService;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Action;
use Psr\Http\Message\ResponseInterface;

class ViewGenreAction extends Action
{
    private ViewGenreService $viewGenreService;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->viewGenreService = new ViewGenreService(
            $genreRepository,
            new ArrayGenreDataTransformer(),
        );
    }

    public function action(): ResponseInterface
    {
        $id = $this->args['id'];

        $viewGenreRequest = new ViewGenreRequest($id);

        $this->viewGenreService->execute($viewGenreRequest);

        $genreDataTransformer = $this->viewGenreService->genreDataTransformer();

        return $this->respondWithData($genreDataTransformer->read());
    }
}
