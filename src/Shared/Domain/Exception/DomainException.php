<?php

declare(strict_types=1);

namespace Bookstore\Shared\Domain\Exception;

use Exception;

class DomainException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
