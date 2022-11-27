<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Create;

use App\Catalog\Domain\Model\Genre\GenreName;

class CreateGenreRequest
{
    public GenreName $genreName;

    public function __construct(string $name)
    {
        $this->genreName = new GenreName($name);
    }
}
