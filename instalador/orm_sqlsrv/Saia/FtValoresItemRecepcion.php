<?php

namespace Saia;

/**
 * FtValoresItemRecepcion
 */
class FtValoresItemRecepcion
{
    /**
     * @var integer
     */
    private $idftValoresItemRecepcion;

    /**
     * @var integer
     */
    private $ftRecepcionCotizacion;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $fkIdftItem;

    /**
     * @var string
     */
    private $valor;


    /**
     * Get idftValoresItemRecepcion
     *
     * @return integer
     */
    public function getIdftValoresItemRecepcion()
    {
        return $this->idftValoresItemRecepcion;
    }

    /**
     * Set ftRecepcionCotizacion
     *
     * @param integer $ftRecepcionCotizacion
     *
     * @return FtValoresItemRecepcion
     */
    public function setFtRecepcionCotizacion($ftRecepcionCotizacion)
    {
        $this->ftRecepcionCotizacion = $ftRecepcionCotizacion;

        return $this;
    }

    /**
     * Get ftRecepcionCotizacion
     *
     * @return integer
     */
    public function getFtRecepcionCotizacion()
    {
        return $this->ftRecepcionCotizacion;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtValoresItemRecepcion
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
     * Set fkIdftItem
     *
     * @param string $fkIdftItem
     *
     * @return FtValoresItemRecepcion
     */
    public function setFkIdftItem($fkIdftItem)
    {
        $this->fkIdftItem = $fkIdftItem;

        return $this;
    }

    /**
     * Get fkIdftItem
     *
     * @return string
     */
    public function getFkIdftItem()
    {
        return $this->fkIdftItem;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return FtValoresItemRecepcion
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
}

