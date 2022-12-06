<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Domain\Model\Genre;

use App\Catalog\Domain\Model\Genre\GenreId;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class GenreIdTest extends TestCase
{
    public function testToString(): void
    {
        $value = Uuid::uuid4()->toString();
        $genreId = new GenreId($value);
        self::assertEquals($value, strval($genreId));
    } 
}
