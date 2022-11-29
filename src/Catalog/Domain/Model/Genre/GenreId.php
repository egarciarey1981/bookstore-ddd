<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Model\Genre;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

class GenreId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->assert($id);
        $this->id = $id;
    }

    private function assert(string $id): void
    {
        $this->assertNotEmpty($id);
        $this->assertUuid($id);
    }

    private function assertNotEmpty(string $id): void
    {
        if (empty($id)) {
            throw new InvalidArgumentException("Empty genre ID");
        }
    }

    private function assertUuid(string $id): void
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException("Genre ID not valid");
        }
    }

    public function equals(self $genreId): bool
    {
        return $this->id === $genreId->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
