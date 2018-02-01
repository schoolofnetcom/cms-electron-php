<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->options('/{routes:.+}', function ($req, $res, $args) {
    return $res;
});

include __DIR__.'/routes/upload.php';
include __DIR__.'/routes/pages.php';
include __DIR__.'/routes/posts.php';
include __DIR__.'/routes/users.php';
include __DIR__.'/routes/auth.php';

$app->get('/{slug}', function ($req, $res, $args) {
    $data = $this->pages_domain->siteData($args['slug']);
    return $this->pages_responder->renderPage($res, $data, $this);
});
