<?php

namespace App\Users;

use App\ADR\Responder as BaseResponder;

class Responder extends BaseResponder
{
    public function authFail($responder, $data)
    {
        return $response->withJson($data, 401);
    }
}
