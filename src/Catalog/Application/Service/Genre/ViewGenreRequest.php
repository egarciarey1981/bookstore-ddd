<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre;

class ViewGenreRequest
{
    public string $id;

    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
