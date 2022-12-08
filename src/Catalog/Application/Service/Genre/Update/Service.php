<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Update;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;

class Service extends GenreService
{
    public function execute(Request $request): void
    {
        $genre = $this->repository->ofId($request->genreId);

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        $genre->setGenreName($request->genreName);

        $this->repository->save($genre);
    }
}
