<?php

namespace App\Shared\Domain\Model\Exception;

class DomainDoesNotExistException extends DomainException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}
