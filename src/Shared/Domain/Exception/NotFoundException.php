<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exception;

use Exception;

class NotFoundException extends Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
