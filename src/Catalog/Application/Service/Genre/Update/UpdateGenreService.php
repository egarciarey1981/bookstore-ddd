<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Update;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreRequest;
use App\Catalog\Application\Service\Genre\Update\UpdateGenreResponse;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use Exception;

class UpdateGenreService extends GenreService
{
    public function execute(UpdateGenreRequest $request): UpdateGenreResponse
    {
        $genre = $this->genreRepository->ofId($request->genreId);

        if (is_null($genre)) {
            throw new GenreNotFoundException();
        }

        $genre->setGenreName($request->genreName);
        
        $this->genreRepository->save($genre);

        return new UpdateGenreResponse($genre);
    }
}
