<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Domain\Model\Genre;

use App\Catalog\Domain\Model\Genre\GenreName;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GenreNameTest extends TestCase
{
    public function testHappyPath(): void
    {
        $genreName = new GenreName('Adventure');
        $this->assertInstanceOf(GenreName::class, $genreName);
    }

    public function testToString(): void
    {
        $value = 'Adventure';
        $genreName = new GenreName($value);
        $this->assertEquals($value, strval($genreName));
    }

    public function testEmpty(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new GenreName('');
    }

    public function testTooShort(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new GenreName('ab');
    }

    public function testTooLong(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new GenreName('this genre name is too long');
    }
}
