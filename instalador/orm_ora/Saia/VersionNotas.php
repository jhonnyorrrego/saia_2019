<?php

namespace Saia;

/**
 * VersionNotas
 */
class VersionNotas
{
    /**
     * @var integer
     */
    private $idversionNotas;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var integer
     */
    private $fkIdversionDocumento;


    /**
     * Get idversionNotas
     *
     * @return integer
     */
    public function getIdversionNotas()
    {
        return $this->idversionNotas;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return VersionNotas
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
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return VersionNotas
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return VersionNotas
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set fkIdversionDocumento
     *
     * @param integer $fkIdversionDocumento
     *
     * @return VersionNotas
     */
    public function setFkIdversionDocumento($fkIdversionDocumento)
    {
        $this->fkIdversionDocumento = $fkIdversionDocumento;

        return $this;
    }

    /**
     * Get fkIdversionDocumento
     *
     * @return integer
     */
    public function getFkIdversionDocumento()
    {
        return $this->fkIdversionDocumento;
    }
}

