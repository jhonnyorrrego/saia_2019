<?php

namespace Saia;

/**
 * TareasListadoNotas
 */
class TareasListadoNotas
{
    /**
     * @var integer
     */
    private $idtareasListadoNotas;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     */
    private $fkTareasListado;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaCreacion;


    /**
     * Get idtareasListadoNotas
     *
     * @return integer
     */
    public function getIdtareasListadoNotas()
    {
        return $this->idtareasListadoNotas;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return TareasListadoNotas
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
     * Set fkTareasListado
     *
     * @param integer $fkTareasListado
     *
     * @return TareasListadoNotas
     */
    public function setFkTareasListado($fkTareasListado)
    {
        $this->fkTareasListado = $fkTareasListado;

        return $this;
    }

    /**
     * Get fkTareasListado
     *
     * @return integer
     */
    public function getFkTareasListado()
    {
        return $this->fkTareasListado;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return TareasListadoNotas
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return TareasListadoNotas
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }
}

