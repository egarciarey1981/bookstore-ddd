<?php

namespace App\Catalog\Application\Service\Author\Create;

class CreateAuthorResponse
{
    private string $authorId;

    public function __construct(string $authorId)
    {
        $this->authorId = $authorId;
    }

    public function authorId(): string
    {
        return $this->authorId;
    }
}
