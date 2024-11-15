<?php

namespace App\Catalog\Application\Service\Author\Delete;

use App\Catalog\Domain\Model\Author\AuthorId;
use App\Catalog\Domain\Model\Author\AuthorRepository;

class DeleteAuthorService
{
    private AuthorRepository $authorRepository;

    public function __construct(AuthorRepository $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function execute(DeleteAuthorRequest $request): void
    {
        $this->authorRepository->remove(
            new AuthorId($request->authorId())
        );
    }
}
