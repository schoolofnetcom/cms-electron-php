<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/api/v1/pages', function (Request $request, Response $response, array $args) {
    $pages = $this->pages_domain->all();
    return $this->pages_responder->all($response, $pages);
});

$app->get('/api/v1/pages/{id}', function (Request $request, Response $response, array $args) {
    $page = $this->pages_domain->findOrFail($args['id']);
    return $this->pages_responder->one($response, $page);
});

$app->put('/api/v1/pages/{id}', function (Request $request, Response $response, array $args) {
    $page = $this->pages_domain->update($args['id']);
    return $this->pages_responder->update($response, $page);
});

$app->delete('/api/v1/pages/{id}', function (Request $request, Response $response, array $args) {
    $page = $this->pages_domain->delete($args['id']);
    return $this->pages_responder->update($response, $page);
});

$app->post('/api/v1/pages', function (Request $request, Response $response, array $args) {
    $page = $this->pages_domain->create();
    return $this->pages_responder->create($response, $page);
});
