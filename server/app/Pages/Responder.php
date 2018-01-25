<?php

namespace App\Pages;

use Slim\Http\Response;

class Responder
{
    public function all(Response $response, $data)
    {
        return $response->withJson($data);
    }

    public function one(Response $response, $data)
    {
        return $response->withJson($data);
    }

    public function update(Response $response, $data)
    {
        return $response->withJson($data);
    }

    public function create(Response $response, $data)
    {
        return $response->withJson($data, 201);
    }
}
