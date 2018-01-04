<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Pages;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Pages: " . Pages::all());

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
