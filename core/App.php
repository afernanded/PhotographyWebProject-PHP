<?php

namespace proyecto\core;


use proyecto\app\exceptions\AppException;
use proyecto\core\database\Connection;

class App
{
    private static $container = [];

    public static function bind($clave, $valor)
    {
        static::$container[$clave] = $valor;
    }

    public static function get($key)
    {
        if (!array_key_exists($key, static::$container)) {
            throw new AppException("No se ha encontrado la clave en el contenedor");
        }
        return static::$container[$key];
    }

    public static function getConnection()
    {
        if (!array_key_exists('connection', static::$container)) {
            static::$container['connection'] = Connection::make();
        }
        return static::$container['connection'];
    }

    public static function getRepository($className) {
        if (!array_key_exists($className,static::$container)) {
            static::$container[$className] = new $className();
        }
        return static::$container[$className];
    }
}