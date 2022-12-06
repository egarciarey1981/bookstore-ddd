<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

class CreateGenreResponse
{
    public function __construct(
        public string $id,
    ) {
    }
}
