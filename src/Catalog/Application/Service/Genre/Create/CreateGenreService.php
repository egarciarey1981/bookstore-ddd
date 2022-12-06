<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreName;

class CreateGenreService extends GenreService
{
    public function execute(CreateGenreRequest $createGenreRequest): CreateGenreResponse
    {
        $genreId = $this->genreRepository->nextId();

        $this->genreRepository->save(
            new Genre(
                $genreId,
                new GenreName($createGenreRequest->name),
            )
        );

        return new CreateGenreResponse($genreId->value());
    }
}
