<?php

namespace App\Catalog\Application\Service\Author\List;

use App\Catalog\Domain\Model\Author\AuthorRepository;

class ListAuthorService
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(): ListAuthorResponse
    {
        $authors = $this->authorRepository->all();

        $authors = array_map(
            fn($author) => $author->toArray(),
            $authors,
        );

        return new ListAuthorResponse($authors);
    }
}
