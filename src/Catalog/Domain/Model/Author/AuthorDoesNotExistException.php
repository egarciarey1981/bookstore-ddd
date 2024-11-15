<?php

namespace App\Catalog\Domain\Model\Author;

use App\Shared\Domain\Model\Exception\DomainDoesNotExistException;

class AuthorDoesNotExistException extends DomainDoesNotExistException
{
    public function __construct(string $message = 'Author does not exist')
    {
        parent::__construct($message);
    }
}
