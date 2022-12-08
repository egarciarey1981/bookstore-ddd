<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Delete;

use Bookstore\Catalog\Domain\Model\Genre\GenreId;

class DeleteGenreRequest
{
    public GenreId $genreId;

    public function __construct(string $id)
    {
        $this->genreId = new GenreId($id);
    }
}
