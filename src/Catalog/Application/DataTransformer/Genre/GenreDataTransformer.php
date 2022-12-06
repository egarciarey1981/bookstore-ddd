<?php

declare(strict_types=1);

namespace App\Catalog\Application\DataTransformer\Genre;

use App\Catalog\Domain\Model\Genre\Genre;

interface GenreDataTransformer
{
    public function write(Genre $genre): void;
    public function read(): mixed;
}
