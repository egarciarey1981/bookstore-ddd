<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Update;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreResponse;
use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use Exception;

class UpdateGenreService extends GenreService
{
    public function execute(UpdateGenreRequest $request): UpdateGenreResponse
    {
        $genre = new Genre(
            $request->genreId,
            $request->genreName,
        );

        if (!$this->genreRepository->contains($genre)) {
            throw new GenreNotFoundException();
        }
        
        if (!$this->genreRepository->save($genre)) {
            throw new Exception();
        }

        return new UpdateGenreResponse($genre);
    }
}
