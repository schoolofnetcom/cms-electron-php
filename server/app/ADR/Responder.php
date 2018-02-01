<?php

namespace App\ADR;

use Slim\Http\Response;

abstract class Responder
{
    public function __call($name, $arguments)
    {
        $response = $arguments[0];
        $data = $arguments[1];
        return $response->withJson($data);
    }
}
