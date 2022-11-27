<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Model\Genre;

class GenreName
{
    private string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
