<?php

namespace App\Catalog\Application\Action\Author;

use App\Catalog\Application\Service\Author\Read\ReadAuthorRequest;
use App\Catalog\Application\Service\Author\Read\ReadAuthorService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetAuthorAction
{
    private ReadAuthorService $readAuthorService;

    public function __construct(ReadAuthorService $readAuthorService)
    {
        $this->readAuthorService = $readAuthorService;
    }

    /** @param array<string> $args */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $readAuthorResponse = $this->readAuthorService->execute(
            new ReadAuthorRequest($args['id'])
        );

        $response->getBody()->write(
            json_encode(['author' => $readAuthorResponse->author()], JSON_THROW_ON_ERROR)
        );

        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }
}
