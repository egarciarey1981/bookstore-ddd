<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Domain\Model\Genre;

use App\Catalog\Domain\Model\Genre\GenreName;
use PHPUnit\Framework\TestCase;

class GenreNameTest extends TestCase
{
    public function testToString(): void
    {
        $value = 'Adventure';
        $genreName = new GenreName($value);
        self::assertEquals($value, strval($genreName));
    } 
}
