<?php

namespace App\Catalog\Application\Action\Author;

use App\Catalog\Application\Service\Author\Update\UpdateAuthorRequest;
use App\Catalog\Application\Service\Author\Update\UpdateAuthorService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PutAuthorAction
{
    private UpdateAuthorService $updateAuthorService;

    public function __construct(UpdateAuthorService $updateAuthorService)
    {
        $this->updateAuthorService = $updateAuthorService;
    }

    /** @param array<string> $args */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        /** @var array<string> $parsedBody */
        $parsedBody = $request->getParsedBody();

        $this->updateAuthorService->execute(
            new UpdateAuthorRequest(
                $args['id'],
                $parsedBody['name'] ?? '',
            )
        );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
