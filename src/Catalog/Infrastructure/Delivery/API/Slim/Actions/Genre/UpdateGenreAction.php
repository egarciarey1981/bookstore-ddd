<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Update\UpdateGenreService;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateGenreAction extends Action
{
    private UpdateGenreService $updateGenreService;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->updateGenreService = new UpdateGenreService($genreRepository);
    }

    public function action(): Response
    {
        $formData = $this->getFormData();

        $updateGenreRequest = new UpdateGenreRequest(
            $this->args['id'],
            $formData['name'],
        );

        $this->updateGenreService->execute($updateGenreRequest);

        return $this->respond(200);
    }
}
