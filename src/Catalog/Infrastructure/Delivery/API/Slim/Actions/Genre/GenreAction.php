<?php

declare(strict_types=1);

namespace Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use Bookstore\Catalog\Domain\Model\Genre\GenreRepository;
use Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Action;

abstract class GenreAction extends Action
{
    protected GenreRepository $genreRepository;

    public function __construct(GenreRepository $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }
}
