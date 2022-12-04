<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;

class ViewGenreService extends GenreService
{
    public function execute(ViewGenreRequest $request): ViewGenreResponse
    {
        $genre = $this->genreRepository->ofId($request->genreId);

        if (is_null($genre)) {
            throw new GenreNotFoundException();
        }

        return new ViewGenreResponse($genre);
    }
}
