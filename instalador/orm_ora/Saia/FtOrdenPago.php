<?php

namespace Saia;

/**
 * FtOrdenPago
 */
class FtOrdenPago
{
    /**
     * @var integer
     */
    private $idftOrdenPago;

    /**
     * @var integer
     */
    private $ftInformeRecibo;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $adicionalesOrden;

    /**
     * @var string
     */
    private $centroCostos;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $pageA;

    /**
     * @var integer
     */
    private $ordenPago;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $observacionesIva;

    /**
     * @var integer
     */
    private $urgenciaPago;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftOrdenPago
     *
     * @return integer
     */
    public function getIdftOrdenPago()
    {
        return $this->idftOrdenPago;
    }

    /**
     * Set ftInformeRecibo
     *
     * @param integer $ftInformeRecibo
     *
     * @return FtOrdenPago
     */
    public function setFtInformeRecibo($ftInformeRecibo)
    {
        $this->ftInformeRecibo = $ftInformeRecibo;

        return $this;
    }

    /**
     * Get ftInformeRecibo
     *
     * @return integer
     */
    public function getFtInformeRecibo()
    {
        return $this->ftInformeRecibo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtOrdenPago
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
     * Set adicionalesOrden
     *
     * @param integer $adicionalesOrden
     *
     * @return FtOrdenPago
     */
    public function setAdicionalesOrden($adicionalesOrden)
    {
        $this->adicionalesOrden = $adicionalesOrden;

        return $this;
    }

    /**
     * Get adicionalesOrden
     *
     * @return integer
     */
    public function getAdicionalesOrden()
    {
        return $this->adicionalesOrden;
    }

    /**
     * Set centroCostos
     *
     * @param string $centroCostos
     *
     * @return FtOrdenPago
     */
    public function setCentroCostos($centroCostos)
    {
        $this->centroCostos = $centroCostos;

        return $this;
    }

    /**
     * Get centroCostos
     *
     * @return string
     */
    public function getCentroCostos()
    {
        return $this->centroCostos;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtOrdenPago
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
     * Set pageA
     *
     * @param string $pageA
     *
     * @return FtOrdenPago
     */
    public function setPageA($pageA)
    {
        $this->pageA = $pageA;

        return $this;
    }

    /**
     * Get pageA
     *
     * @return string
     */
    public function getPageA()
    {
        return $this->pageA;
    }

    /**
     * Set ordenPago
     *
     * @param integer $ordenPago
     *
     * @return FtOrdenPago
     */
    public function setOrdenPago($ordenPago)
    {
        $this->ordenPago = $ordenPago;

        return $this;
    }

    /**
     * Get ordenPago
     *
     * @return integer
     */
    public function getOrdenPago()
    {
        return $this->ordenPago;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtOrdenPago
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
     * Set observacionesIva
     *
     * @param string $observacionesIva
     *
     * @return FtOrdenPago
     */
    public function setObservacionesIva($observacionesIva)
    {
        $this->observacionesIva = $observacionesIva;

        return $this;
    }

    /**
     * Get observacionesIva
     *
     * @return string
     */
    public function getObservacionesIva()
    {
        return $this->observacionesIva;
    }

    /**
     * Set urgenciaPago
     *
     * @param integer $urgenciaPago
     *
     * @return FtOrdenPago
     */
    public function setUrgenciaPago($urgenciaPago)
    {
        $this->urgenciaPago = $urgenciaPago;

        return $this;
    }

    /**
     * Get urgenciaPago
     *
     * @return integer
     */
    public function getUrgenciaPago()
    {
        return $this->urgenciaPago;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtOrdenPago
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
     * @param integer $dependencia
     *
     * @return FtOrdenPago
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtOrdenPago
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return integer
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtOrdenPago
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtOrdenPago
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}

