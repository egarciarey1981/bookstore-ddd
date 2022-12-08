<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Domain\Model\Genre;

use InvalidArgumentException;

class GenreId
{
    private const PATTERN = '/$[[:xdigit:]]{8}\-[[:xdigit:]]{4}\-[[:xdigit:]]{4}\-[[:xdigit:]]{4}\-[[:xdigit:]]{12}^/';

    private string $value;

    public function __construct(string $value)
    {
        $this->assert($value);
        $this->value = $value;
    }

    private function assert(string $value): void
    {
        if (false === preg_match(self::PATTERN, $value)) {
            throw new InvalidArgumentException();
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function equals(GenreId $genreId): bool
    {
        return $this->value === $genreId->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
