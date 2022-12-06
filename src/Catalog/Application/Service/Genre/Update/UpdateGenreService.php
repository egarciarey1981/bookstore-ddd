<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Update;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;

class UpdateGenreService extends GenreService
{
    public function execute(UpdateGenreRequest $request): void
    {
        $genreId = new GenreId($request->id);
        $genre = $this->genreRepository->ofId($genreId);

        if (is_null($genre)) {
            throw new GenreNotFoundException();
        }

        $genreName = new GenreName($request->name);
        $genre->setGenreName($genreName);
        
        $this->genreRepository->save($genre);
    }
}
