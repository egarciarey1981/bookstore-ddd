<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Domain\Model\Genre;

use App\Catalog\Domain\Model\Genre\Genre;
use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;

class GenreObjectMother
{
    public static function createOne(): Genre
    {
        $faker = \Faker\Factory::create();

        return new Genre(
            new GenreId($faker->uuid()),
            new GenreName($faker->text(10)),
        );
    }
}
