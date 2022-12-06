<?php

declare(strict_types=1);

namespace Tests\Integration\Catalog\Persistence\InMemory;

use App\Catalog\Infrastructure\Persistence\InMemory\InMemoryGenreRepository;
use PHPUnit\Framework\TestCase;
use Tests\Unit\Catalog\Domain\Model\Genre\GenreObjectMother;

class CreateGenreServiceTest extends TestCase
{
    public function testContains(): void
    {
        $genre = GenreObjectMother::createOne();

        $repo = new InMemoryGenreRepository();
        $repo->save($genre);

        self::assertTrue($repo->contains($genre));
    }

    public function testSave(): void
    {
        $genre = GenreObjectMother::createOne();

        $repo = new InMemoryGenreRepository();
        $repo->save($genre);

        $genreFound = $repo->ofId($genre->genreId());

        self::assertTrue($genre->equals($genreFound));
        self::assertTrue($genre->genreId()->equals($genreFound->genreId()));
        self::assertTrue($genre->genreName()->equals($genreFound->genreName()));
    }

    public function testAll(): void
    {
        $repo = new InMemoryGenreRepository();
        $genres = [];

        for ($i = 0; $i < 5; $i++) {
            $genre = GenreObjectMother::createOne();
            $genres[] = $genre;
            $repo->save($genre);
        }

        $genresFound = $repo->all();

        self::assertEquals(count($genres), count($genresFound));

        foreach ($genres as $genre) {
            foreach ($genresFound as $genreFound) {
                if ($genre->equals($genreFound)) {
                    self::assertTrue(true);
                    continue 2;
                }
            }
            self::assertTrue(false);
        }
    }

    public function testNotFound(): void
    {
        $repo = new InMemoryGenreRepository();
        $genreId = $repo->nextId();
        self::assertNull($repo->ofId($genreId));
    }


    public function testRemove(): void
    {
        $genre = GenreObjectMother::createOne();
        $repo = new InMemoryGenreRepository();

        $repo->save($genre);
        self::assertNotNull($repo->ofId($genre->genreId()));

        $repo->remove($genre);
        self::assertNull($repo->ofId($genre->genreId()));
    }
}
