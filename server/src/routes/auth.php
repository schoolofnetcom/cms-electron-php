<?php

use Slim\Http\Request;
use Slim\Http\Response;
use Firebase\JWT\JWT;

$app->post('/auth/token', function (Request $request, Response $response, array $args) {
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    $user = $this->users_domain->where('email', $email)->first();

    if (!is_null($user) and password_verify($password, $user->password)) {
        $key = $this->get('secretKey');

        return $this->users_responder->auth($response, [
            'status' => 'success',
            'token' => JWT::encode($user, $key)
        ]);
    }

    return $this->user_responder->authFail($response, ['status' => 'error']);
});
