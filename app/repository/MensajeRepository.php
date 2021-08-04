<?php

namespace proyecto\app\repository;

use proyecto\app\entity\Mensaje;
use proyecto\core\database\QueryBuilder;

class MensajeRepository extends QueryBuilder
{
    public function __construct($table = 'mensajes', $classEntity = mensaje::class)
    {
        parent::__construct($table, $classEntity);
    }

    public function guarda($mensaje) {
        $fnGuardaMensaje = function () use ($mensaje){
            $this->save($mensaje);
        };
        $this->executeTransaction($fnGuardaMensaje);
    }
}