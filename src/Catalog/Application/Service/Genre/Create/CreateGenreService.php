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
        $genre = new Genre(
            $this->genreRepository->nextId(),
            new GenreName($createGenreRequest->name),
        );

        $this->genreRepository->save($genre);

        return new CreateGenreResponse($genre->genreId()->value());
    }
}
