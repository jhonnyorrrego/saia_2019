<?php

namespace Saia;

/**
 * Error
 */
class Error
{
    /**
     * @var integer
     */
    private $iderror;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     */
    private $codigoError;

    /**
     * @var string
     */
    private $archivo;

    /**
     * @var string
     */
    private $origen;

    /**
     * @var \DateTime
     */
    private $fecha;


    /**
     * Get iderror
     *
     * @return integer
     */
    public function getIderror()
    {
        return $this->iderror;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return Error
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
     * Set codigoError
     *
     * @param string $codigoError
     *
     * @return Error
     */
    public function setCodigoError($codigoError)
    {
        $this->codigoError = $codigoError;

        return $this;
    }

    /**
     * Get codigoError
     *
     * @return string
     */
    public function getCodigoError()
    {
        return $this->codigoError;
    }

    /**
     * Set archivo
     *
     * @param string $archivo
     *
     * @return Error
     */
    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;

        return $this;
    }

    /**
     * Get archivo
     *
     * @return string
     */
    public function getArchivo()
    {
        return $this->archivo;
    }

    /**
     * Set origen
     *
     * @param string $origen
     *
     * @return Error
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return string
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Error
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

