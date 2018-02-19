<?php

namespace Saia;

/**
 * PasoCondicionalAdmin
 */
class PasoCondicionalAdmin
{
    /**
     * @var integer
     */
    private $idpasoCondicionalAdmin;

    /**
     * @var integer
     */
    private $fkPasoCondicional;

    /**
     * @var integer
     */
    private $fkCamposFormato;

    /**
     * @var string
     */
    private $comparacion;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var string
     */
    private $habilitarPasosSi;

    /**
     * @var string
     */
    private $habilitarPasosNo;

    /**
     * @var integer
     */
    private $orden;

    /**
     * @var integer
     */
    private $estado;


    /**
     * Get idpasoCondicionalAdmin
     *
     * @return integer
     */
    public function getIdpasoCondicionalAdmin()
    {
        return $this->idpasoCondicionalAdmin;
    }

    /**
     * Set fkPasoCondicional
     *
     * @param integer $fkPasoCondicional
     *
     * @return PasoCondicionalAdmin
     */
    public function setFkPasoCondicional($fkPasoCondicional)
    {
        $this->fkPasoCondicional = $fkPasoCondicional;

        return $this;
    }

    /**
     * Get fkPasoCondicional
     *
     * @return integer
     */
    public function getFkPasoCondicional()
    {
        return $this->fkPasoCondicional;
    }

    /**
     * Set fkCamposFormato
     *
     * @param integer $fkCamposFormato
     *
     * @return PasoCondicionalAdmin
     */
    public function setFkCamposFormato($fkCamposFormato)
    {
        $this->fkCamposFormato = $fkCamposFormato;

        return $this;
    }

    /**
     * Get fkCamposFormato
     *
     * @return integer
     */
    public function getFkCamposFormato()
    {
        return $this->fkCamposFormato;
    }

    /**
     * Set comparacion
     *
     * @param string $comparacion
     *
     * @return PasoCondicionalAdmin
     */
    public function setComparacion($comparacion)
    {
        $this->comparacion = $comparacion;

        return $this;
    }

    /**
     * Get comparacion
     *
     * @return string
     */
    public function getComparacion()
    {
        return $this->comparacion;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return PasoCondicionalAdmin
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set habilitarPasosSi
     *
     * @param string $habilitarPasosSi
     *
     * @return PasoCondicionalAdmin
     */
    public function setHabilitarPasosSi($habilitarPasosSi)
    {
        $this->habilitarPasosSi = $habilitarPasosSi;

        return $this;
    }

    /**
     * Get habilitarPasosSi
     *
     * @return string
     */
    public function getHabilitarPasosSi()
    {
        return $this->habilitarPasosSi;
    }

    /**
     * Set habilitarPasosNo
     *
     * @param string $habilitarPasosNo
     *
     * @return PasoCondicionalAdmin
     */
    public function setHabilitarPasosNo($habilitarPasosNo)
    {
        $this->habilitarPasosNo = $habilitarPasosNo;

        return $this;
    }

    /**
     * Get habilitarPasosNo
     *
     * @return string
     */
    public function getHabilitarPasosNo()
    {
        return $this->habilitarPasosNo;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return PasoCondicionalAdmin
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
     * Set estado
     *
     * @param integer $estado
     *
     * @return PasoCondicionalAdmin
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }
}

