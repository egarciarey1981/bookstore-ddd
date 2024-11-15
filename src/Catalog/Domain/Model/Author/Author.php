<?php

namespace App\Catalog\Domain\Model\Author;

class Author
{
    private AuthorId $id;
    private AuthorName $name;

    public function __construct(
        AuthorId $id,
        AuthorName $name,
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function id(): AuthorId
    {
        return $this->id;
    }

    public function name(): AuthorName
    {
        return $this->name;
    }

    /** @return array<string> */
    public function toArray(): array
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
        ];
    }
}
