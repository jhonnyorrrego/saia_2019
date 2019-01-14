<?php

namespace Saia;

/**
 * FtSolicitudCompra
 */
class FtSolicitudCompra
{
    /**
     * @var integer
     */
    private $idftSolicitudCompra;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $dependencia;

    /**
     * @var string
     */
    private $nombreProyecto;

    /**
     * @var string
     */
    private $area;

    /**
     * @var string
     */
    private $tipoContrato;

    /**
     * @var string
     */
    private $objeto;

    /**
     * @var string
     */
    private $justificacion;

    /**
     * @var string
     */
    private $cuantia;

    /**
     * @var string
     */
    private $anexos;

    /**
     * @var string
     */
    private $gerenteArea;

    /**
     * @var string
     */
    private $digitalizar;


    /**
     * Get idftSolicitudCompra
     *
     * @return integer
     */
    public function getIdftSolicitudCompra()
    {
        return $this->idftSolicitudCompra;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudCompra
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudCompra
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set dependencia
     *
     * @param string $dependencia
     *
     * @return FtSolicitudCompra
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return string
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set nombreProyecto
     *
     * @param string $nombreProyecto
     *
     * @return FtSolicitudCompra
     */
    public function setNombreProyecto($nombreProyecto)
    {
        $this->nombreProyecto = $nombreProyecto;

        return $this;
    }

    /**
     * Get nombreProyecto
     *
     * @return string
     */
    public function getNombreProyecto()
    {
        return $this->nombreProyecto;
    }

    /**
     * Set area
     *
     * @param string $area
     *
     * @return FtSolicitudCompra
     */
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get area
     *
     * @return string
     */
    public function getArea()
    {
        return $this->area;
    }

    /**
     * Set tipoContrato
     *
     * @param string $tipoContrato
     *
     * @return FtSolicitudCompra
     */
    public function setTipoContrato($tipoContrato)
    {
        $this->tipoContrato = $tipoContrato;

        return $this;
    }

    /**
     * Get tipoContrato
     *
     * @return string
     */
    public function getTipoContrato()
    {
        return $this->tipoContrato;
    }

    /**
     * Set objeto
     *
     * @param string $objeto
     *
     * @return FtSolicitudCompra
     */
    public function setObjeto($objeto)
    {
        $this->objeto = $objeto;

        return $this;
    }

    /**
     * Get objeto
     *
     * @return string
     */
    public function getObjeto()
    {
        return $this->objeto;
    }

    /**
     * Set justificacion
     *
     * @param string $justificacion
     *
     * @return FtSolicitudCompra
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return string
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * Set cuantia
     *
     * @param string $cuantia
     *
     * @return FtSolicitudCompra
     */
    public function setCuantia($cuantia)
    {
        $this->cuantia = $cuantia;

        return $this;
    }

    /**
     * Get cuantia
     *
     * @return string
     */
    public function getCuantia()
    {
        return $this->cuantia;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtSolicitudCompra
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set gerenteArea
     *
     * @param string $gerenteArea
     *
     * @return FtSolicitudCompra
     */
    public function setGerenteArea($gerenteArea)
    {
        $this->gerenteArea = $gerenteArea;

        return $this;
    }

    /**
     * Get gerenteArea
     *
     * @return string
     */
    public function getGerenteArea()
    {
        return $this->gerenteArea;
    }

    /**
     * Set digitalizar
     *
     * @param string $digitalizar
     *
     * @return FtSolicitudCompra
     */
    public function setDigitalizar($digitalizar)
    {
        $this->digitalizar = $digitalizar;

        return $this;
    }

    /**
     * Get digitalizar
     *
     * @return string
     */
    public function getDigitalizar()
    {
        return $this->digitalizar;
    }
}

