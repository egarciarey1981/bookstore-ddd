<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\View;

use App\Catalog\Application\DataTransformer\Genre\GenreDataTransformer;
use App\Catalog\Application\Service\Genre\View\ViewGenreRequest;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreNotFoundException;
use App\Catalog\Domain\Model\Genre\GenreRepository;

class ViewGenreService
{
    private GenreRepository $genreRepository;
    private GenreDataTransformer $genreDataTransformer;

    public function __construct(
        GenreRepository $genreRepository,
        GenreDataTransformer $genreDataTransformer,
    ) {
        $this->genreRepository = $genreRepository;
        $this->genreDataTransformer = $genreDataTransformer;
    }

    public function execute(ViewGenreRequest $viewGenreRequest): void
    {
        $genre = $this->genreRepository->ofId(
            new GenreId($viewGenreRequest->id)
        );

        if (is_null($genre)) {
            throw new GenreNotFoundException();
        }

        $this->genreDataTransformer->write($genre);
    }

    public function genreDataTransformer(): GenreDataTransformer
    {
        return $this->genreDataTransformer;
    }
}
