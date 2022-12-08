<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Create;

class CreateGenreResponse
{
    /**
     * @var array<string>
     */
    public array $genre;

    /**
     * @param array<string> $genre
     */
    public function __construct(array $genre)
    {
        $this->genre = $genre;
    }
}
