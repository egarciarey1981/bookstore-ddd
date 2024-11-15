<?php

namespace App\Catalog\Application\Service\Author\List;

class ListAuthorResponse
{
    /** @var array<array<string>> */
    private $authors;

    /** @param array<array<string>> $authors */
    public function __construct(array $authors)
    {
        $this->authors = $authors;
    }

    /** @return array<array<string>> */
    public function authors(): array
    {
        return $this->authors;
    }
}
