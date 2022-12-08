<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;

class Service extends GenreService
{
    public function execute(Request $request): Response
    {
        $genre = $this->repository->ofId($request->genreId);

        if (null === $genre) {
            throw new GenreNotFoundException();
        }

        return new Response($genre);
    }

}
