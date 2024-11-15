<?php

namespace App\Catalog\Application\Service\Author\Create;

class CreateAuthorRequest
{
    private string $authorName;

    public function __construct(string $authorName)
    {
        $this->authorName = $authorName;
    }

    public function authorName(): string
    {
        return $this->authorName;
    }
}
