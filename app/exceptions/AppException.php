<?php

namespace proyecto\app\exceptions;

use Exception;
use proyecto\core\Response;

class AppException extends Exception
{
    public function __construct($message = "", $code = 500)
    {
        parent::__construct($message, $code);
    }

    public function handleError()
    {
        try {
            $httpHeaderMessage = $this->getHttpHeaderMessage();

            header($_SERVER['SERVER_PROTOCOL'] . ' ' . $httpHeaderMessage,
                true, $this->getCode());

            $errorMessage = $this->getMessage();

            Response::renderView('error', 'layout',
                compact('httpHeaderMessage', 'errorMessage'));
        } catch (Exception $exception) {
            die('Se ha producido un error en nuestro manejador de excepciones');
        }
    }

    private function getHttpHeaderMessage()
    {
        switch ($this->getCode()) {
            case 404:
            {
                return '404 Not Found';
            }
            case 403:
            {
                return '403 Forbidden';
            }
            case 500:
            {
                return '500 Internal Server Error';
            }
        }
    }
}