<?php

namespace App\Catalog\Domain\Model\Author;

use App\Shared\Domain\Model\Exception\DomainAlreadyExistsException;

class AuthorAlreadyExistsException extends DomainAlreadyExistsException
{
    public function __construct(string $message = 'Author already exists')
    {
        parent::__construct($message);
    }
}
