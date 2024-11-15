<?php

namespace App\Catalog\Application\Service\Author\Update;

class UpdateAuthorRequest
{
    private string $authorId;
    private string $authorName;

    public function __construct(
        string $authorId,
        string $authorName,
    ) {
        $this->authorId = $authorId;
        $this->authorName = $authorName;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }

    public function authorName(): string
    {
        return $this->authorName;
    }
}
