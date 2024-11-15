<?php

use DI\ContainerBuilder;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Set up repositories
$repositories = require __DIR__ . '/../app/repositories.php';
$repositories($containerBuilder);

// Build PHP-DI Container instance
$container = $containerBuilder->build();

// Instantiate the app
AppFactory::setContainer($container);
$app = AppFactory::create();
$callableResolver = $app->getCallableResolver();

// Register routes
$routes = require __DIR__ . '/../app/routes.php';
$routes($app);

// Add Routing Middleware
$app->addRoutingMiddleware();

// Add Body Parsing Middleware
$app->addBodyParsingMiddleware();

// Define Custom Error Handler
$customErrorHandler = require __DIR__ . '/../app/errors.php';

// Add Error Middleware
$errorMiddleware = $app->addErrorMiddleware(true, true, true);
$errorMiddleware->setDefaultErrorHandler($customErrorHandler);

$app->run();
