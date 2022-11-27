<?php

declare(strict_types=1);

use App\Catalog\Infrastructure\Delivery\API\Slim\Actions\Genre\ViewGenreAction;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->group('/catalog/genres', function (Group $group) {
        $group->get('', ViewGenreAction::class);
        $group->get('/{id}', ViewGenreAction::class);
    });
};