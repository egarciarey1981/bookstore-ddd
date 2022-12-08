<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Create;

use Bookstore\Catalog\Domain\Model\Genre\Genre;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;

class CreateGenreService
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CreateGenreRequest $request): CreateGenreResponse
    {
        $genre = new Genre(
            $this->repository->nextId(),
            $request->genreName
        );

        $this->repository->save($genre);

        return new CreateGenreResponse($genre);
    }
}
