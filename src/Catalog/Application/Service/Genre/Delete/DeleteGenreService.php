<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Delete;

use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;

class DeleteGenreService
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }
    
    public function execute(DeleteGenreRequest $request): void
    {
        $genre = $this->repository->ofId($request->genreId);

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        $this->repository->remove($genre);
    }
}
