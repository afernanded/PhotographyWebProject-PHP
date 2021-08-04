<?php

namespace proyecto\app\utils;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class MyLogs
{
    private $log;
    private $level;
    /**
     * MyLogs constructor.
     * @param $log
     */
    private function __construct($filename, $nivelLog)
    {
        $this->level = $nivelLog;
        $this->log = new Logger('name');
        $this->log->pushHandler(
            new StreamHandler($filename, $this->level));
    }

    public static function load($filename, $level = Logger::INFO){
        return new MyLogs($filename, $level);
    }

    public function add($message){
        $this->log->log($this->level, $message);
    }
}