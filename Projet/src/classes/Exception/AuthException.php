<?php

namespace iutnc\netVOD\exception;

use Exception;

class AuthException extends Exception
{
    function __construct(string $msg, int $code)
    {
        parent::__construct($msg, $code);
    }
}