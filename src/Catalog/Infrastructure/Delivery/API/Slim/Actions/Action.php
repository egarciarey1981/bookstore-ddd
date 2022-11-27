<?php

declare(strict_types=1);

namespace App\Catalog\Infrastructure\Delivery\API\Slim\Actions;

use App\Shared\Domain\Exception\NotFoundException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Throwable;

abstract class Action
{
    protected Request $request;
    protected Response $response;
    protected array $args;

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        try {
            return $this->action();
        } catch (NotFoundException $e) {
            return $this->respondWithData(['errors' => $e->getMessage()], 404);
        } catch (Throwable $t) {
            return $this->respondWithData(['errors' => 'An unexpected error occurred'], 500);
        }
    }

    abstract protected function action(): Response;

    protected function respondWithData(array $data, int $statusCode = 200): Response
    {
        $json = json_encode($data, JSON_PRETTY_PRINT);

        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($statusCode);
    }

    protected function respond(int $statusCode): Response
    {
        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($statusCode);
    }
}
