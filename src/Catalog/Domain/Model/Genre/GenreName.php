<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Model\Genre;

use InvalidArgumentException;

class GenreName
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 20;

    private string $name;

    public function __construct(string $name)
    {
        $this->assert($name);
        $this->name = $name;
    }

    private function assert(string $name): void
    {
        $this->assertNotTooShort($name);
        $this->assertNotTooLong($name);
    }

    private function assertNotTooShort(string $name): void
    {
        if (strlen($name) < self::MIN_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('The genre name must be %d characters or more', self::MIN_LENGTH)
            );
        }
    }

    private function assertNotTooLong(string $name): void
    {
        if (strlen($name) > self::MAX_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('The genre name must be %d characters or less', self::MAX_LENGTH)
            );
        }
    }

    public function equals(self $genreName): bool
    {
        return $this->name === $genreName->name;
    }

    public function __toString(): string
    {
        return $this->name;
    }
}
