<?php

namespace Saia;

/**
 * TareasListadoAnexos
 */
class TareasListadoAnexos
{
    /**
     * @var integer
     */
    private $idtareasListadoAnexos;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var integer
     */
    private $fkTareasListado;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var \DateTime
     */
    private $fechaHora;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;


    /**
     * Get idtareasListadoAnexos
     *
     * @return integer
     */
    public function getIdtareasListadoAnexos()
    {
        return $this->idtareasListadoAnexos;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return TareasListadoAnexos
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return TareasListadoAnexos
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
     * Set fkTareasListado
     *
     * @param integer $fkTareasListado
     *
     * @return TareasListadoAnexos
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return TareasListadoAnexos
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set fechaHora
     *
     * @param \DateTime $fechaHora
     *
     * @return TareasListadoAnexos
     */
    public function setFechaHora($fechaHora)
    {
        $this->fechaHora = $fechaHora;

        return $this;
    }

    /**
     * Get fechaHora
     *
     * @return \DateTime
     */
    public function getFechaHora()
    {
        return $this->fechaHora;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return TareasListadoAnexos
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
}

