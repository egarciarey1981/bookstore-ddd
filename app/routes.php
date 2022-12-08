<?php

declare(strict_types=1);

use Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre\CreateGenreAction;
use Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre\DeleteGenreAction;
use Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre\ReadGenreAction;
use Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre\SearchGenreAction;
use Bookstore\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre\UpdateGenreAction;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/catalog/genre', function (Group $group) {
        $group->get('', SearchGenreAction::class);
        $group->get('/{id}', ReadGenreAction::class);
        $group->post('', CreateGenreAction::class);
        $group->put('/{id}', UpdateGenreAction::class);
        $group->delete('/{id}', DeleteGenreAction::class);
    });
};
