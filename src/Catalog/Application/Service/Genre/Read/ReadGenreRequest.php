<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Read;

use Bookstore\Catalog\Domain\Model\Genre\GenreId;

class ReadGenreRequest
{
    public GenreId $genreId;

    public function __construct(string $id) {
        $this->genreId = new GenreId($id);
    }
}
