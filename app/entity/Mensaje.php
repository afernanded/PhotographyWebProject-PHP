<?php

namespace proyecto\app\entity;

use proyecto\core\database\IEntity;

class Mensaje implements IEntity
{
    private $nombre;
    private $apellidos;
    private $asunto;
    private $email;
    private $texto;

    /**
     * mensaje constructor.
     * @param $id
     * @param $nombre
     * @param $apellidos
     * @param $asunto
     * @param $email
     * @param $texto
     */
    public function __construct($nombre, $apellidos, $asunto, $email, $texto)
    {
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->asunto = $asunto;
        $this->email = $email;
        $this->texto = $texto;
    }

    /**
     * @return mixed|string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed|string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed|string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param mixed|string $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return mixed|string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * @param mixed|string $asunto
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;
    }

    /**
     * @return mixed|string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed|string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed|string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * @param mixed|string $texto
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    }

    public function toArray()
    {
        return [
            'nombre' => $this->getNombre(),
            'apellidos' => $this->getApellidos(),
            'asunto' => $this->getAsunto(),
            'email' => $this->getEmail(),
            'texto' => $this->getTexto(),
        ];
    }


}