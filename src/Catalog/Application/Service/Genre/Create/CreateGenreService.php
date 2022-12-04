<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Domain\Model\Genre\Genre;
use Exception;

class CreateGenreService extends GenreService
{
    public function execute(CreateGenreRequest $request): CreateGenreResponse
    {
        $genre = new Genre(
            $this->genreRepository->nextId(),
            $request->genreName
        );

        if (!$this->genreRepository->save($genre)) {
            throw new Exception();
        }

        return new CreateGenreResponse($genre);
    }
}
