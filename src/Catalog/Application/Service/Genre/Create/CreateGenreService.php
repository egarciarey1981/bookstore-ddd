<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Domain\Model\Genre\Genre;

class CreateGenreService extends GenreService
{
    public function execute(CreateGenreRequest $request): CreateGenreResponse
    {
        $genre = new Genre(
            $this->genreRepository->nextId(),
            $request->genreName,
        );

        $this->genreRepository->save($genre);

        return new CreateGenreResponse($genre);
    }
}
