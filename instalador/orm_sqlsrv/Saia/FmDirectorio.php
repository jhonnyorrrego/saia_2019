<?php

namespace Saia;

/**
 * FmDirectorio
 */
class FmDirectorio
{
    /**
     * @var integer
     */
    private $iddirectorio;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     */
    private $regionalIdregional;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var integer
     */
    private $directorioIddirectorio;

    /**
     * @var integer
     */
    private $propietario;


    /**
     * Get iddirectorio
     *
     * @return integer
     */
    public function getIddirectorio()
    {
        return $this->iddirectorio;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return FmDirectorio
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FmDirectorio
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set regionalIdregional
     *
     * @param integer $regionalIdregional
     *
     * @return FmDirectorio
     */
    public function setRegionalIdregional($regionalIdregional)
    {
        $this->regionalIdregional = $regionalIdregional;

        return $this;
    }

    /**
     * Get regionalIdregional
     *
     * @return integer
     */
    public function getRegionalIdregional()
    {
        return $this->regionalIdregional;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FmDirectorio
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set directorioIddirectorio
     *
     * @param integer $directorioIddirectorio
     *
     * @return FmDirectorio
     */
    public function setDirectorioIddirectorio($directorioIddirectorio)
    {
        $this->directorioIddirectorio = $directorioIddirectorio;

        return $this;
    }

    /**
     * Get directorioIddirectorio
     *
     * @return integer
     */
    public function getDirectorioIddirectorio()
    {
        return $this->directorioIddirectorio;
    }

    /**
     * Set propietario
     *
     * @param integer $propietario
     *
     * @return FmDirectorio
     */
    public function setPropietario($propietario)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return integer
     */
    public function getPropietario()
    {
        return $this->propietario;
    }
}

