<?php

namespace proyecto\app\repository;

use proyecto\app\entity\Categoria;
use proyecto\core\database\QueryBuilder;

class CategoriaRepository extends QueryBuilder
{
    /**
     * categoriaRepository constructor.
     */
    public function __construct($table='categorias', $classEntity= categoria::class)
    {
        parent::__construct($table, $classEntity);
    }

    public function nuevaImagen(Categoria $categoria) {
        $categoria->setNumImagenes($categoria->getNumImagenes() + 1);
        $this->update($categoria);
    }
}