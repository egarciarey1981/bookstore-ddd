<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Application\Service\Genre\Create;

use Bookstore\Catalog\Domain\Model\Genre\GenreName;

class CreateGenreRequest
{
    public GenreName $genreName;

    public function __construct(string $name) {
        $this->genreName = new GenreName($name);
    }
}
