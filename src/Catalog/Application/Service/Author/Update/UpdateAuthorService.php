<?php

namespace App\Catalog\Application\Service\Author\Update;

use App\Catalog\Domain\Model\Author\Author;
use App\Catalog\Domain\Model\Author\AuthorId;
use App\Catalog\Domain\Model\Author\AuthorName;
use App\Catalog\Domain\Model\Author\AuthorRepository;

class UpdateAuthorService
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(UpdateAuthorRequest $request): void
    {
        $this->authorRepository->update(
            new Author(
                new AuthorId($request->authorId()),
                new AuthorName($request->authorName()),
            )
        );
    }
}
