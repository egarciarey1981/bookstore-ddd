<?php

namespace App\Catalog\Domain\Model\Author;

interface AuthorRepository
{
    /** @return array<Author> */
    public function all(): array;
    public function nextIdentity(): AuthorId;
    public function add(Author $author): void;
    public function update(Author $author): void;
    public function authorOfId(AuthorId $authorId): ?Author;
    public function remove(AuthorId $authorId): void;
}
