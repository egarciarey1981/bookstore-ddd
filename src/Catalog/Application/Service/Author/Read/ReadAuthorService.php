<?php

namespace App\Catalog\Application\Service\Author\Read;

use App\Catalog\Domain\Model\Author\AuthorDoesNotExistException;
use App\Catalog\Domain\Model\Author\AuthorId;
use App\Catalog\Domain\Model\Author\AuthorRepository;

class ReadAuthorService
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(ReadAuthorRequest $request): ReadAuthorResponse
    {
        $author = $this->authorRepository->authorOfId(
            new AuthorId($request->authorId())
        );

        if (is_null($author)) {
            throw new AuthorDoesNotExistException();
        }

        return new ReadAuthorResponse($author->toArray());
    }
}
