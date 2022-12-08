<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Domain\Model\Genre;

use InvalidArgumentException;

class GenreName
{
    private const MIN_LENGTH = 3;
    private const MAX_LENGTH = 20;

    private string $value;

    public function __construct(string $value)
    {
        $this->assert($value);
        $this->value = $value;
    }

    private function assert(string $value): void
    {
        $this->assertNotTooShort($value);
        $this->assertNotTooLong($value);
    }

    private function assertNotTooShort(string $value): void
    {
        if (strlen($value) < self::MIN_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('The genre name must be %d characters or more', self::MIN_LENGTH)
            );
        }
    }

    private function assertNotTooLong(string $value): void
    {
        if (strlen($value) > self::MAX_LENGTH) {
            throw new InvalidArgumentException(
                sprintf('The genre name must be %d characters or less', self::MAX_LENGTH)
            );
        }
    }

    public function equals(GenreName $genreName): bool
    {
        return $this->value === $genreName->value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
