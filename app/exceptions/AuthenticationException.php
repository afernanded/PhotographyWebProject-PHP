<?php


namespace proyecto\app\exceptions;


class AuthenticationException extends AppException
{
    public function __construct($message = "", $code = 403)
    {
        parent::__construct($message, $code);
    }
}