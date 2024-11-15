<?php

namespace App\Catalog\Domain\Model\Author;

class AuthorId
{
    private string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function value(): string
    {
        return $this->value;
    }

    public static function create(): AuthorId
    {
        return new self(uniqid());
    }

    public function equalsTo(AuthorId $authorId): bool
    {
        return $this->value() === $authorId->value();
    }
}
