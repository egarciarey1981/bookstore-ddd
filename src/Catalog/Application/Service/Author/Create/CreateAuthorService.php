<?php

namespace App\Catalog\Application\Service\Author\Create;

use App\Catalog\Domain\Model\Author\Author;
use App\Catalog\Domain\Model\Author\AuthorName;
use App\Catalog\Domain\Model\Author\AuthorRepository;

class CreateAuthorService
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(CreateAuthorRequest $request): CreateAuthorResponse
    {
        $authorId = $this->authorRepository->nextIdentity();

        $this->authorRepository->add(
            new Author(
                $authorId,
                new AuthorName($request->authorName()),
            )
        );

        return new CreateAuthorResponse($authorId->value());
    }
}
