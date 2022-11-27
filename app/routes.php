<?php

declare(strict_types=1);

use App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre\ListGenreAction;
use App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre\ViewGenreAction;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/catalog/genre', function (Group $group) {
        $group->get('', ListGenreAction::class);
        $group->get('/{id}', ViewGenreAction::class);
    });
};