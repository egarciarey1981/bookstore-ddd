<?php

use App\Shared\Domain\Model\Exception\DomainAlreadyExistsException;
use App\Shared\Domain\Model\Exception\DomainDoesNotExistException;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

return function (Request $request, Throwable $exception) {
    list($status, $message) = match (true) {
        $exception instanceof DomainAlreadyExistsException => [400, $exception->getMessage()],
        $exception instanceof DomainDoesNotExistException => [404, $exception->getMessage()],
        default => [500, 'Something went wrong!'],
    };

    $response = new Response();
    $response->getBody()->write(
        json_encode(['error' => $message], JSON_THROW_ON_ERROR)
    );

    return $response
        ->withHeader('Content-Type', 'application/json')
        ->withStatus($status);
};
