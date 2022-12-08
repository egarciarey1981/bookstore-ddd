<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Read;

use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;
use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;

class ReadGenreService
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(ReadGenreRequest $request): ReadGenreResponse
    {
        $genre = $this->repository->ofId(
            $request->genreId
        );

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        return new ReadGenreResponse($genre);
    }
}
