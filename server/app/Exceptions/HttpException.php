<?php

namespace App\Exceptions;

abstract class HttpException extends \Exception
{
    abstract public function getStatusCode() :int;
}
