<?php

namespace App\Exceptions;

class UnprocessableEntityException extends HttpException
{
    public function getStatusCode() :int
    {
        return 422;
    }
}
