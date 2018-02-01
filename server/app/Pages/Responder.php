<?php

namespace App\Pages;

use App\ADR\Responder as BaseResponder;

class Responder extends BaseResponder
{
    public function renderPage($response, $data, $app)
    {
        return $app->view->render($response, 'page.phtml', $data);
    }
}
