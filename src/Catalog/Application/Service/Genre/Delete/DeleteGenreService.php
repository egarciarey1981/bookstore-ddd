<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Delete;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Shared\Domain\Exception\NotFoundException;

class DeleteGenreService extends GenreService
{
    public function execute(DeleteGenreRequest $request): DeleteGenreResponse
    {
        $genre = $this->genreRepository->ofId($request->genreId);

        if (is_null($genre)) {
            throw new NotFoundException('Genre not found');
        }

        $this->genreRepository->remove($genre);

        return new DeleteGenreResponse();
    }
}
