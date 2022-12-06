<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Delete;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;

class DeleteGenreService extends GenreService
{
    public function execute(DeleteGenreRequest $deleteGenreRequest): void
    {
        $genreId = new GenreId($deleteGenreRequest->id);

        $genre = $this->genreRepository->ofId($genreId);

        if (is_null($genre)) {
            throw new GenreNotFoundException();
        }

        $this->genreRepository->remove($genre);
    }
}
