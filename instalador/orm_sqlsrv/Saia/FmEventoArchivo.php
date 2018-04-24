<?php

namespace Saia;

/**
 * FmEventoArchivo
 */
class FmEventoArchivo
{
    /**
     * @var integer
     */
    private $idfmEventoArchivo;

    /**
     * @var integer
     */
    private $fmArchivoIdarchivo;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     */
    private $accion;

    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Get idfmEventoArchivo
     *
     * @return integer
     */
    public function getIdfmEventoArchivo()
    {
        return $this->idfmEventoArchivo;
    }

    /**
     * Set fmArchivoIdarchivo
     *
     * @param integer $fmArchivoIdarchivo
     *
     * @return FmEventoArchivo
     */
    public function setFmArchivoIdarchivo($fmArchivoIdarchivo)
    {
        $this->fmArchivoIdarchivo = $fmArchivoIdarchivo;

        return $this;
    }

    /**
     * Get fmArchivoIdarchivo
     *
     * @return integer
     */
    public function getFmArchivoIdarchivo()
    {
        return $this->fmArchivoIdarchivo;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FmEventoArchivo
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
     * Set accion
     *
     * @param string $accion
     *
     * @return FmEventoArchivo
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return string
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FmEventoArchivo
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
}

