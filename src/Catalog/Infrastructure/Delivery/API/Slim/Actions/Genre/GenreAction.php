<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre;

use App\Catalog\Domain\Model\Genre\GenreRepository as Repository;
use App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Action;

abstract class GenreAction extends Action
{
    protected Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }
}
