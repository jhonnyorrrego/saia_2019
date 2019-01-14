<?php

namespace Saia;

/**
 * FtContactoAdicional
 */
class FtContactoAdicional
{
    /**
     * @var integer
     */
    private $idftContactoAdicional;

    /**
     * @var integer
     */
    private $ftReadh;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var integer
     */
    private $identificacion;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $telefono;


    /**
     * Get idftContactoAdicional
     *
     * @return integer
     */
    public function getIdftContactoAdicional()
    {
        return $this->idftContactoAdicional;
    }

    /**
     * Set ftReadh
     *
     * @param integer $ftReadh
     *
     * @return FtContactoAdicional
     */
    public function setFtReadh($ftReadh)
    {
        $this->ftReadh = $ftReadh;

        return $this;
    }

    /**
     * Get ftReadh
     *
     * @return integer
     */
    public function getFtReadh()
    {
        return $this->ftReadh;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtContactoAdicional
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set identificacion
     *
     * @param integer $identificacion
     *
     * @return FtContactoAdicional
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return integer
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return FtContactoAdicional
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return FtContactoAdicional
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }
}

