<?php

namespace Saia;

/**
 * PantallaLibreria
 */
class PantallaLibreria
{
    /**
     * @var integer
     */
    private $idpantallaLibreria;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var integer
     */
    private $orden;

    /**
     * @var string
     */
    private $tipoArchivo;

    /**
     * @var integer
     */
    private $tipoLibreria;


    /**
     * Get idpantallaLibreria
     *
     * @return integer
     */
    public function getIdpantallaLibreria()
    {
        return $this->idpantallaLibreria;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return PantallaLibreria
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
     * @return PantallaLibreria
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PantallaLibreria
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
     * Set orden
     *
     * @param integer $orden
     *
     * @return PantallaLibreria
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set tipoArchivo
     *
     * @param string $tipoArchivo
     *
     * @return PantallaLibreria
     */
    public function setTipoArchivo($tipoArchivo)
    {
        $this->tipoArchivo = $tipoArchivo;

        return $this;
    }

    /**
     * Get tipoArchivo
     *
     * @return string
     */
    public function getTipoArchivo()
    {
        return $this->tipoArchivo;
    }

    /**
     * Set tipoLibreria
     *
     * @param integer $tipoLibreria
     *
     * @return PantallaLibreria
     */
    public function setTipoLibreria($tipoLibreria)
    {
        $this->tipoLibreria = $tipoLibreria;

        return $this;
    }

    /**
     * Get tipoLibreria
     *
     * @return integer
     */
    public function getTipoLibreria()
    {
        return $this->tipoLibreria;
    }
}

