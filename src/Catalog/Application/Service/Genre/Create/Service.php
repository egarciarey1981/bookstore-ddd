<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

use App\Catalog\Application\Service\Genre\GenreService;
use App\Catalog\Application\Service\Genre\Create\Response;
use App\Catalog\Application\Service\Genre\Create\Request;
use App\Catalog\Domain\Model\Genre\Genre;

class Service extends GenreService
{
    public function execute(Request $request): Response
    {
        $genre = new Genre(
            $this->repository->nextId(),
            $request->genreName
        );

        $this->repository->save($genre);

        return new Response($genre);
    }
}
