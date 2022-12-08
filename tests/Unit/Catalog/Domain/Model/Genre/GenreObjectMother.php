<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Domain\Model\Genre;

use Bookstore\Catalog\Domain\Model\Genre\Genre;
use Bookstore\Catalog\Domain\Model\Genre\GenreId;
use Bookstore\Catalog\Domain\Model\Genre\GenreName;
use Ramsey\Uuid\Uuid;

class GenreObjectMother
{
    public static function createOne(): Genre
    {
        return new Genre(
            new GenreId(Uuid::uuid4()->toString()),
            new GenreName('Aventure'),
        );
    }
}
