<?php

namespace proyecto\app\entity;

use proyecto\core\database\IEntity;

class Categoria implements IEntity
{
    private $id;
    private $nombre;
    private $numImagenes;

    /**
     * categoria constructor.
     * @param $id
     * @param $nombre
     * @param $numImagenes
     */
    public function __construct($nombre='', $numImagenes=0)
    {
        $this->nombre = $nombre;
        $this->numImagenes = $numImagenes;
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'numImagenes' => $this->getNumImagenes()
        ];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getNumImagenes()
    {
        return $this->numImagenes;
    }

    /**
     * @param mixed $numImagenes
     */
    public function setNumImagenes($numImagenes): void
    {
        $this->numImagenes = $numImagenes;
    }




}