<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Update;

class UpdateGenreRequest
{
    public string $id;
    public string $name;

    public function __construct(string $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
