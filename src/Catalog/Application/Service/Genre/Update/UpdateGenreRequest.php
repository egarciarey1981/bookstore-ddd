<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Update;

use Bookstore\Catalog\Domain\Model\Genre\GenreId;
use Bookstore\Catalog\Domain\Model\Genre\GenreName;

class UpdateGenreRequest
{
    public GenreId $genreId;
    public GenreName $genreName;

    public function __construct(string $id, string $name)
    {
        $this->genreId = new GenreId($id);
        $this->genreName = new GenreName($name);
    }
}
