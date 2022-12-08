<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Read;

use Bookstore\Catalog\Application\Service\Genre\GenreService;
use Bookstore\Catalog\Domain\Model\Genre\GenreId;
use Bookstore\Catalog\Domain\Model\Genre\GenreNotFoundException;

class ReadGenreService extends GenreService
{
    public function execute(ReadGenreRequest $request): ReadGenreResponse
    {
        $genre = $this->genreRepository->genreOfId(
            new GenreId($request->id)
        );

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        return new ReadGenreResponse($genre->toArray());
    }
}
