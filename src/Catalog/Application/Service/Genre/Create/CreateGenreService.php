<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Create;

use Bookstore\Catalog\Application\Service\Genre\GenreService;
use Bookstore\Catalog\Domain\Model\Genre\Genre;
use Bookstore\Catalog\Domain\Model\Genre\GenreName;

class CreateGenreService extends GenreService
{
    public function execute(CreateGenreRequest $request): CreateGenreResponse
    {
        $genre = new Genre(
            $this->genreRepository->nextIdentity(),
            new GenreName($request->name)
        );

        $this->genreRepository->save($genre);

        return new CreateGenreResponse($genre->toArray());
    }
}
