<?php

namespace App\Catalog\Infrastructure\Persistence\InMemory;

use App\Catalog\Domain\Model\Author\Author;
use App\Catalog\Domain\Model\Author\AuthorAlreadyExistsException;
use App\Catalog\Domain\Model\Author\AuthorDoesNotExistException;
use App\Catalog\Domain\Model\Author\AuthorId;
use App\Catalog\Domain\Model\Author\AuthorName;
use App\Catalog\Domain\Model\Author\AuthorRepository;

class InMemoryAuthorRepository implements AuthorRepository
{
    /** @var array<Author> $authors */
    private array $authors;

    /** @param array<Author> $authors */
    public function __construct(array $authors = [])
    {
        if (empty($authors)) {
            $authors = $this->defaultAuthors();
        }

        $this->authors = $authors;
    }

    public function nextIdentity(): AuthorId
    {
        return AuthorId::create();
    }

    /** @return array<Author> */
    public function all(): array
    {
        return $this->authors;
    }

    public function add(Author $author): void
    {
        try {
            $this->authorOfId($author->id());
        } catch (AuthorDoesNotExistException $e) {
            throw new AuthorAlreadyExistsException();
        }

        $this->authors[] = $author;
    }

    public function update(Author $author): void
    {
        foreach ($this->authors as $key => $existingAuthor) {
            if ($existingAuthor->id()->equalsTo($author->id())) {
                $this->authors[$key] = $author;
                return;
            }
        }

        throw new AuthorDoesNotExistException();
    }

    public function authorOfId(AuthorId $authorId): Author
    {
        foreach ($this->authors as $author) {
            if ($author->id()->equalsTo($authorId)) {
                return $author;
            }
        }

        throw new AuthorDoesNotExistException();
    }

    public function remove(AuthorId $authorId): void
    {
        foreach ($this->authors as $key => $author) {
            if ($author->id()->equalsTo($authorId)) {
                unset($this->authors[$key]);
                return;
            }
        }

        throw new AuthorDoesNotExistException();
    }

    /** @return array<Author> */
    private function defaultAuthors(): array
    {
        $authors = [
            [
                'id' => 'author-1',
                'name' => 'Author 1',
            ],
            [
                'id' => 'author-2',
                'name' => 'Author 2',
            ],
            [
                'id' => 'author-3',
                'name' => 'Author 3',
            ]
        ];

        return array_map(function ($author) {
            return new Author(
                new AuthorId($author['id']),
                new AuthorName($author['name'])
            );
        }, $authors);
    }
}
