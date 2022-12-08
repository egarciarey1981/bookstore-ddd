<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Delete;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Application\Service\Genre\Delete\DeleteGenreRequest as Request;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;

class DeleteGenreService extends GenreService
{
    public function execute(Request $request): void
    {
        $genre = $this->repository->ofId($request->genreId);

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        $this->repository->remove($genre);
    }
}
