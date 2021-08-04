<?php

namespace proyecto\app\repository;

use proyecto\app\entity\ImagenGaleria;
use proyecto\core\database\QueryBuilder;

class ImagenGaleriaRepository extends QueryBuilder
{
    public function __construct($table = 'imagenes', $classEntity = imagenGaleria::class)
    {
        parent::__construct($table, $classEntity);
    }

    public function getCategoria(ImagenGaleria $imagenGaleria) {
        $categoriaRepository = new CategoriaRepository();
        return $categoriaRepository->find($imagenGaleria->getCategoria());
    }

    public function guarda(ImagenGaleria $imagenGaleria) {
        $fnGuardaImagen = function () use ($imagenGaleria){
            $categoria = $this->getCategoria($imagenGaleria);
            $categoriaRepository = new CategoriaRepository();
            $categoriaRepository->nuevaImagen($categoria);
            $this->save($imagenGaleria);
        };
        $this->executeTransaction($fnGuardaImagen);
    }
}