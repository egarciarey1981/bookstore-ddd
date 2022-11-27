<?php

declare(strict_types=1);

namespace App\Catalog\Domain\Model\Genre;

use App\Shared\Domain\Exception\NotFoundException;

class GenreNotFoundException extends NotFoundException
{
    public function __construct(string $message = 'Genre not found')
    {
        parent::__construct($message);
    }
}
