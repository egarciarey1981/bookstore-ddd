<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre;

use App\Catalog\Domain\Model\Genre\GenreRepository;

class GenreService
{
    protected GenreRepository $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }
}
