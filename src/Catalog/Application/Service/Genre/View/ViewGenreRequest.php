<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\View;

class ViewGenreRequest
{
    public function __construct(
        public string $id,
    ) {
    }
}
