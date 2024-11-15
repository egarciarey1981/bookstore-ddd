<?php

namespace App\Catalog\Application\Action\Author;

use App\Catalog\Application\Service\Author\List\ListAuthorService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetAuthorsAction
{
    private ListAuthorService $listAuthorService;

    public function __construct(ListAuthorService $listAuthorService)
    {
        $this->listAuthorService = $listAuthorService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        $listAuthorResponse = $this->listAuthorService->execute();

        $response->getBody()->write(
            json_encode(['authors' => $listAuthorResponse->authors()], JSON_THROW_ON_ERROR)
        );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
