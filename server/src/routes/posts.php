<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->get('/api/v1/posts', function (Request $request, Response $response, array $args) {
    $posts = $this->posts_domain->all();
    return $this->posts_responder->all($response, $posts);
});

$app->get('/api/v1/posts/{id}', function (Request $request, Response $response, array $args) {
    $post = $this->posts_domain->findOrFail($args['id']);
    return $this->posts_responder->one($response, $post);
});

$app->put('/api/v1/posts/{id}', function (Request $request, Response $response, array $args) {
    $post = $this->posts_domain->update($args['id']);
    return $this->posts_responder->update($response, $post);
});

$app->delete('/api/v1/posts/{id}', function (Request $request, Response $response, array $args) {
    $post = $this->posts_domain->delete($args['id']);
    return $this->posts_responder->update($response, $post);
});

$app->post('/api/v1/posts', function (Request $request, Response $response, array $args) {
    $post = $this->posts_domain->create();
    return $this->posts_responder->create($response, $post);
});
