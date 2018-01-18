<?php

use Slim\Http\Request;
use Slim\Http\Response;
use App\Pages\Domain as Pages;

// Routes

$app->options('/{routes:.+}', function ($req, $res, $args) {
    return $res;
});

$app->get('/api/v1/pages', function (Request $request, Response $response, array $args) {
    $pages = $this->pages_domain->all();
    return $this->pages_responder->all($response, $pages);
});

$app->post('/api/v1/pages', function (Request $request, Response $response, array $args) {
    $page = $this->pages_domain->create();
    return $this->pages_responder->create($response, $page);
});
