<?php

namespace proyecto\app\entity;

use proyecto\core\database\IEntity;

class ImagenGaleria implements IEntity
{
    const RUTA_IMAGENES_PORTFOLIO = 'images/index/portfolio/';
    const RUTA_IMAGENES_GALLERY = 'images/index/gallery/';

    private $nombre;
    private $descripcion;
    private $numVisualizaciones;
    private $numLikes;
    private $numDownloads;
    private $id;

    /**
     * imagenGaleria constructor.
     * @param $nombre
     * @param $descripcion
     * @param $numVisualizaciones
     * @param $numLikes
     * @param $numDownloads
     */
    public function __construct($nombre = '', $descripcion = '', $categoria = 0, $numVisualizaciones = 0, $numLikes = 0, $numDownloads = 0)
    {
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->numVisualizaciones = $numVisualizaciones;
        $this->numLikes = $numLikes;
        $this->numDownloads = $numDownloads;
        $this->id = null;
        $this->categoria = $categoria;
    }

    public function getId()
    {
        return $this->id;
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

    /**
     * @return mixed
     */
    public function getNumVisualizaciones()
    {
        return $this->numVisualizaciones;
    }

    /**
     * @param mixed $numVisualizaciones
     */
    public function setNumVisualizaciones($numVisualizaciones)
    {
        $this->numVisualizaciones = $numVisualizaciones;
    }

    /**
     * @return mixed
     */
    public function getNumLikes()
    {
        return $this->numLikes;
    }

    /**
     * @param mixed $numLikes
     */
    public function setNumLikes($numLikes)
    {
        $this->numLikes = $numLikes;
    }

    /**
     * @return mixed
     */
    public function getNumDownloads()
    {
        return $this->numDownloads;
    }

    /**
     * @param mixed $numDownloads
     */
    public function setNumDownloads($numDownloads)
    {
        $this->numDownloads = $numDownloads;
    }

    public function getUrlPortfolio()
    {
        return self::RUTA_IMAGENES_PORTFOLIO . $this->getNombre();
    }

    public function getUrlGallery()
    {
        return self::RUTA_IMAGENES_GALLERY . $this->getNombre();
    }

    /**
     * @return int|mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @param int|mixed $categoria
     */
    public function setCategoria($categoria): void
    {
        $this->categoria = $categoria;
    }



    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'nombre' => $this->getNombre(),
            'descripcion' => $this->getDescripcion(),
            'numVisualizaciones' => $this->getNumVisualizaciones(),
            'numLikes' => $this->getNumLikes(),
            'numDownloads' => $this->getNumDownloads(),
            'categoria' => $this->getCategoria()
        ];
    }
}