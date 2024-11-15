<?php

use App\Catalog\Application\Action\Author\DeleteAuthorAction;
use App\Catalog\Application\Action\Author\GetAuthorAction;
use App\Catalog\Application\Action\Author\GetAuthorsAction;
use App\Catalog\Application\Action\Author\PostAuthorAction;
use App\Catalog\Application\Action\Author\PutAuthorAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->get('/', function (Request $request, Response $response) {
        $response->getBody()->write('Hello world!');
        return $response;
    });

    $app->group('/authors', function (Group $group) {
        $group->get('', GetAuthorsAction::class);
        $group->get('/{id}', GetAuthorAction::class);
        $group->post('', PostAuthorAction::class);
        $group->put('/{id}', PutAuthorAction::class);
        $group->delete('/{id}', DeleteAuthorAction::class);
    });
};