<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre;

use App\Catalog\Domain\Model\Genre\GenreRepository as Repository;

class GenreService
{
    protected Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }
}
