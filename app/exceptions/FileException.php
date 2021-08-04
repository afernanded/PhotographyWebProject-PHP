<?php

namespace proyecto\app\exceptions;

use Exception;

class FileException extends Exception
{
    public function __construct($mensaje)
    {
        parent::__construct($mensaje);
    }
}