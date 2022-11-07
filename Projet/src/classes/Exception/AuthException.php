<?php

namespace iutnc\netVOD\Exception;

use Exception;

class AuthException extends Exception
{
    function __construct(string $msg)
    {
        parent::__construct($msg);
    }
}