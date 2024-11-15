<?php

namespace App\Catalog\Application\Service\Author\Read;

class ReadAuthorResponse
{
    /** @var array<string> */
    private array $author;

    /** @param array<string> $author*/
    public function __construct(array $author)
    {
        $this->author = $author;
    }

    /** @return array<string> */
    public function author(): array
    {
        return $this->author;
    }
}
