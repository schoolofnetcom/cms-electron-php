<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/api/v1/users', function (Request $request, Response $response, array $args) {
    $users = $this->users_domain->all();
    return $this->users_responder->all($response, $users);
});

$app->get('/api/v1/users/{id}', function (Request $request, Response $response, array $args) {
    $user = $this->users_domain->findOrFail($args['id']);
    return $this->users_responder->one($response, $user);
});

$app->put('/api/v1/users/{id}', function (Request $request, Response $response, array $args) {
    $user = $this->users_domain->update($args['id']);
    return $this->users_responder->update($response, $user);
});

$app->delete('/api/v1/users/{id}', function (Request $request, Response $response, array $args) {
    $user = $this->users_domain->delete($args['id']);
    return $this->users_responder->update($response, $user);
});

$app->post('/api/v1/users', function (Request $request, Response $response, array $args) {
    $user = $this->users_domain->create();
    return $this->users_responder->create($response, $page);
});
