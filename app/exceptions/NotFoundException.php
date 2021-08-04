<?php

namespace proyecto\app\exceptions;


class NotFoundException extends AppException
{
    public function __construct($message = "", $code = 404)
    {
        parent::__construct($message, $code);
    }
}