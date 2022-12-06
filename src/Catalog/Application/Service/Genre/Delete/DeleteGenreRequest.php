<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Delete;

class DeleteGenreRequest
{
    public function __construct(
        public string $id,
    ) {
    }
}
