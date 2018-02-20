<?php

namespace Saia;

/**
 * Evento
 */
class Evento
{
    /**
     * @var integer
     */
    private $idevento;

    /**
     * @var string
     */
    private $funcionarioCodigo;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $evento;

    /**
     * @var string
     */
    private $tablaE;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var integer
     */
    private $registroId;

    /**
     * @var string
     */
    private $detalle;

    /**
     * @var string
     */
    private $codigoSql;


    /**
     * Get idevento
     *
     * @return integer
     */
    public function getIdevento()
    {
        return $this->idevento;
    }

    /**
     * Set funcionarioCodigo
     *
     * @param string $funcionarioCodigo
     *
     * @return Evento
     */
    public function setFuncionarioCodigo($funcionarioCodigo)
    {
        $this->funcionarioCodigo = $funcionarioCodigo;

        return $this;
    }

    /**
     * Get funcionarioCodigo
     *
     * @return string
     */
    public function getFuncionarioCodigo()
    {
        return $this->funcionarioCodigo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Evento
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
     * Set evento
     *
     * @param string $evento
     *
     * @return Evento
     */
    public function setEvento($evento)
    {
        $this->evento = $evento;

        return $this;
    }

    /**
     * Get evento
     *
     * @return string
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set tablaE
     *
     * @param string $tablaE
     *
     * @return Evento
     */
    public function setTablaE($tablaE)
    {
        $this->tablaE = $tablaE;

        return $this;
    }

    /**
     * Get tablaE
     *
     * @return string
     */
    public function getTablaE()
    {
        return $this->tablaE;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return Evento
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set registroId
     *
     * @param integer $registroId
     *
     * @return Evento
     */
    public function setRegistroId($registroId)
    {
        $this->registroId = $registroId;

        return $this;
    }

    /**
     * Get registroId
     *
     * @return integer
     */
    public function getRegistroId()
    {
        return $this->registroId;
    }

    /**
     * Set detalle
     *
     * @param string $detalle
     *
     * @return Evento
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }

    /**
     * Set codigoSql
     *
     * @param string $codigoSql
     *
     * @return Evento
     */
    public function setCodigoSql($codigoSql)
    {
        $this->codigoSql = $codigoSql;

        return $this;
    }

    /**
     * Get codigoSql
     *
     * @return string
     */
    public function getCodigoSql()
    {
        return $this->codigoSql;
    }
}

