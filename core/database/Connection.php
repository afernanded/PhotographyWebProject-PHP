<?php

namespace proyecto\core\database;

use PDO;
use PDOException;
use proyecto\app\exceptions\AppException;
use proyecto\core\App;

class Connection
{
    public static function make() {
        try {
            $config = App::get('config')['database'];
            $connection = new PDO(
                $config['connection'] . ';dbname=' . $config['name'],
                $config['username'], $config['password'],
                $config['options']
            );
        }
        catch (PDOException $PDOException){
            throw new AppException('No se ha podido crear la conexion a la BD');
        }
        return $connection;
    }
}
