<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Application\Service\Genre\Create\CreateGenreRequest;
use App\Catalog\Application\Service\Genre\Create\CreateGenreService;
use App\Catalog\Domain\Model\Genre\GenreRepository;
use App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Action;
use Psr\Http\Message\ResponseInterface;

class CreateGenreAction extends Action
{
    private CreateGenreService $createGenreService;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->createGenreService = new CreateGenreService($genreRepository);
    }

    public function action(): ResponseInterface
    {
        $formData = $this->getFormData();

        $createGenreRequest = new CreateGenreRequest($formData['name']);

        $createGenreResponse = $this->createGenreService->execute($createGenreRequest);

        $this->setHeader('Location', '/catalog/genre/' . $createGenreResponse->id);

        return $this->respond(201);
    }
}
