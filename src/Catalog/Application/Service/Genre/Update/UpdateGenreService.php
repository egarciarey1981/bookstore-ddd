<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Update;

use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;

class UpdateGenreService
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(UpdateGenreRequest $request): void
    {
        $genre = $this->repository->ofId($request->genreId);

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        $genre->setGenreName($request->genreName);

        $this->repository->save($genre);
    }
}
