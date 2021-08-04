<?php


namespace proyecto\app\repository;


use proyecto\app\entity\Usuario;
use proyecto\core\database\QueryBuilder;

class UsuarioRepository extends QueryBuilder
{
    public function __construct($table='usuarios', $classEntity=Usuario::class)
    {
        parent::__construct($table, $classEntity);
    }
}