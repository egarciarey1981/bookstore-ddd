<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Search;

use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;

class SearchGenreService
{
    private GenreRepository $repository;

    public function __construct(GenreRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(SearchGenreRequest $request): SearchGenreResponse
    {
        $genres = $this->repository->all();

        return new SearchGenreResponse(...$genres);
    }
}
