<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Delete;

use Bookstore\Catalog\Application\Service\Genre\GenreService;
use Bookstore\Catalog\Domain\Model\Genre\GenreId;
use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;

class DeleteGenreService extends GenreService
{
    public function execute(DeleteGenreRequest $request): void
    {
        $genre = $this->genreRepository->genreOfId(
            new GenreId($request->id)
        );

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        $this->genreRepository->remove($genre);
    }
}
