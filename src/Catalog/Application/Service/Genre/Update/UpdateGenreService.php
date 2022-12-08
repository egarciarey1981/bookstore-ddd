<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Update;

use Bookstore\Catalog\Application\Service\Genre\GenreService;
use Bookstore\Catalog\Domain\Model\Genre\GenreId;
use Bookstore\Catalog\Domain\Model\Genre\GenreName;
use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;

class UpdateGenreService extends GenreService
{
    public function execute(UpdateGenreRequest $request): void
    {
        $genre = $this->genreRepository->genreOfId(
            new GenreId($request->id)
        );

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        $genre->setGenreName(
            new GenreName($request->name)
        );

        $this->genreRepository->save($genre);
    }
}
