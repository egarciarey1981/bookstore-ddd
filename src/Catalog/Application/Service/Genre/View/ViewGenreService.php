<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Shared\Domain\Exception\NotFoundException;

class ViewGenreService extends GenreService
{
    public function execute(ViewGenreRequest $request): ViewGenreResponse
    {
        $genreId = new GenreId($request->id);

        $genre = $this->genreRepository->ofId($genreId);

        if (is_null($genre)) {
            throw new NotFoundException('Genre not found');
        }

        return new ViewGenreResponse($genre);
    }
}
