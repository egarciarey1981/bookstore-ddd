<?php

namespace App\Catalog\Application\Action\Author;

use App\Catalog\Application\Service\Author\Create\CreateAuthorRequest;
use App\Catalog\Application\Service\Author\Create\CreateAuthorService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostAuthorAction
{
    private CreateAuthorService $createAuthorService;

    public function __construct(CreateAuthorService $createAuthorService)
    {
        $this->createAuthorService = $createAuthorService;
    }

    public function __invoke(Request $request, Response $response): Response
    {
        /** @var array<string> $parsedBody */
        $parsedBody = $request->getParsedBody();

        $createAuthorResponse = $this->createAuthorService->execute(
            new CreateAuthorRequest(
                $parsedBody['name'] ?? '',
            )
        );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withHeader('Location', '/authors/' . $createAuthorResponse->authorId())
            ->withStatus(201);
    }
}
