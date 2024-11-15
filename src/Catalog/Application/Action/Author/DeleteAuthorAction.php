<?php

namespace App\Catalog\Application\Action\Author;

use App\Catalog\Application\Service\Author\Delete\DeleteAuthorRequest;
use App\Catalog\Application\Service\Author\Delete\DeleteAuthorService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class DeleteAuthorAction
{
    private DeleteAuthorService $deleteAuthorService;

    public function __construct(DeleteAuthorService $deleteAuthorService)
    {
        $this->deleteAuthorService = $deleteAuthorService;
    }

    /**
     * @param array<string> $args
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->deleteAuthorService->execute(
            new DeleteAuthorRequest($args['id'])
        );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(204);
    }
}
