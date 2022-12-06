<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

class CreateGenreRequest
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
