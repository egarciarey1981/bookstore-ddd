<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Update;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreResponse;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;

class UpdateGenreService extends GenreService
{
    public function execute(UpdateGenreRequest $request): UpdateGenreResponse
    {
        $oldGenre = $this->genreRepository->genreOfId($request->genreId);

        if (is_null($oldGenre)) {
            throw new GenreNotFoundException();
        }

        $newGenre = $oldGenre->changeName($request->genreName);

        $this->genreRepository->save($newGenre);

        return new UpdateGenreResponse($newGenre);
    }
}
