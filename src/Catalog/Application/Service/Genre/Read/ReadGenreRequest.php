<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Read;

class ReadGenreRequest
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
