<?php

declare(strict_types=1);

namespace Tests\Unit\Catalog\Domain\Model\Genre;

use App\Catalog\Domain\Model\Genre\GenreId;
use PHPUnit\Framework\TestCase;

class GenreIdTest extends TestCase
{
    public function testCreate(): void
    {
        $genreId = GenreId::create();
        $this->assertInstanceOf(GenreId::class, $genreId);
    }

    public function testHappyPath(): void
    {
        $genreId = new GenreId('bd207a1c-fe19-4ed2-a61b-c315ca95d38c');
        $this->assertInstanceOf(GenreId::class, $genreId);
    }

    public function testEquals(): void
    {
        $value = 'bd207a1c-fe19-4ed2-a61b-c315ca95d38c';

        $genreId1 = new GenreId($value);
        $genreId2 = new GenreId($value);

        $this->assertTrue($genreId1->equals($genreId2));
    }

    public function testNotEquals(): void
    {
        $genreId1 = new GenreId('50df20ba-cb69-4184-b851-cce89e01e419');
        $genreId2 = new GenreId('bd207a1c-fe19-4ed2-a61b-c315ca95d38c');

        $this->assertFalse($genreId1->equals($genreId2));
    }
}
