<?php

namespace proyecto\app\repository;

use proyecto\app\entity\Asociado;
use proyecto\core\database\QueryBuilder;

class AsociadosRepository extends QueryBuilder
{
    public function __construct($table = 'asociados', $classEntity = asociado::class)
    {
        parent::__construct($table, $classEntity);
    }

    public function guarda($asociado) {
        $fnGuardaAsociado = function () use ($asociado){
            $this->save($asociado);
        };
        $this->executeTransaction($fnGuardaAsociado);
    }
}