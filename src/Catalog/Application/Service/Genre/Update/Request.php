<?php

declare(strict_types=1);

namespace App\Catalog\Application\Service\Genre\Update;

use App\Catalog\Domain\Model\Genre\GenreId;
use App\Catalog\Domain\Model\Genre\GenreName;

class Request
{
    public GenreId $genreId;
    public GenreName $genreName;

    public function __construct(string $id, string $name)
    {
        $this->genreId = new GenreId($id);
        $this->genreName = new GenreName($name);
    }
}
