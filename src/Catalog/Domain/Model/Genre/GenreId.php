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

    public static function generate(): GenreId
    {
        $uuid = Uuid::uuid4();
        return new self($uuid->toString());
    }

    public function __toString(): string
    {
        return $this->id;
    }

    public function equals(self $other): bool
    {
        return $this->id === $other->id;
    }

    private function assert(string $id): void
    {
        if (!Uuid::isValid($id)) {
            throw new InvalidArgumentException("No genre ID valid: $id");
        }
    }
}
