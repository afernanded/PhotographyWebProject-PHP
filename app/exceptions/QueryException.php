<?php

namespace proyecto\app\exceptions;

class QueryException extends AppException
{
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }
}