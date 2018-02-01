<?php

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/api/v1/image/upload', function (Request $request, Response $response, array $args) {
    if (empty($_FILES['upload'])) {
        return $response->withJson(['uploaded' => false]);
    }

    $file = $_FILES['upload'];

    if ($file['error']) {
        return $response->withJson(['uploaded' => false, 'error' => 'Upload error code: ' . $file['error']]);
    }

    $types = ['image/jpeg', 'image/png', 'image/gif'];

    if (!in_array($file['type'], $types)) {
        return $response->withJson(['uploaded' => false, 'error' => 'Type not allowed']);
    }

    $destionation = __DIR__ . '/../../public/uploads/' . $file['name'];

    if (!move_uploaded_file($file['tmp_name'], $destionation)) {
        return $response->withJson(['uploaded' => false, 'error' => 'File not moved']);
    }

    return $response->withJson(['uploaded' => true, 'url' => $this->get('settings')['domain'] . '/uploads/' . $file['name']]);
});
