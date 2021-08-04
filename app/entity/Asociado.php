<?php

namespace proyecto\app\entity;

use proyecto\core\database\IEntity;

class Asociado implements IEntity
{
    const RUTA_ASOCIADOS_LOGO = 'images/logo/';

    private $id;
    private $nombre;
    private $logo;
    private $descripcion;

    /**
     * asociado constructor.
     * @param $nombre
     * @param $logo
     * @param $descripcion
     */
    public function __construct($nombre='', $logo='', $descripcion='')
    {
        $this->nombre = $nombre;
        $this->logo = $logo;
        $this->descripcion = $descripcion;
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
    public function setId($id)
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
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getUrlAsociado()
    {
        return self::RUTA_ASOCIADOS_LOGO . $this->getLogo();
    }

    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'logo' => $this->getLogo(),
            'descripcion' => $this->getDescripcion()
        ];
    }
}