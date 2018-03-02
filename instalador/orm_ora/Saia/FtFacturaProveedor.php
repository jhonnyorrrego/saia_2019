<?php

namespace Saia;

/**
 * FtFacturaProveedor
 */
class FtFacturaProveedor
{
    /**
     * @var integer
     */
    private $idftFacturaProveedor;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $cia;

    /**
     * @var string
     */
    private $tipoDoc;

    /**
     * @var \DateTime
     */
    private $fechaExp;

    /**
     * @var \DateTime
     */
    private $fechaVenc;

    /**
     * @var string
     */
    private $numFactura;

    /**
     * @var string
     */
    private $prooveedor;

    /**
     * @var integer
     */
    private $tipoMoneda;

    /**
     * @var string
     */
    private $enviar;

    /**
     * @var \DateTime
     */
    private $fechaFactura;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var integer
     */
    private $caja;

    /**
     * @var string
     */
    private $unidadDocumenta;

    /**
     * @var integer
     */
    private $requiereIrecibo;

    /**
     * @var string
     */
    private $numeroGuia;

    /**
     * @var string
     */
    private $empresaGuia;

    /**
     * @var string
     */
    private $ordenCompra;

    /**
     * @var string
     */
    private $archivoUbicacion;

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
     * @var string
     */
    private $valorFactura;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftFacturaProveedor
     *
     * @return integer
     */
    public function getIdftFacturaProveedor()
    {
        return $this->idftFacturaProveedor;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtFacturaProveedor
     */
    public function setAnexoFormato($anexoFormato)
    {
        $this->anexoFormato = $anexoFormato;

        return $this;
    }

    /**
     * Get anexoFormato
     *
     * @return string
     */
    public function getAnexoFormato()
    {
        return $this->anexoFormato;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFacturaProveedor
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
     * Set cia
     *
     * @param string $cia
     *
     * @return FtFacturaProveedor
     */
    public function setCia($cia)
    {
        $this->cia = $cia;

        return $this;
    }

    /**
     * Get cia
     *
     * @return string
     */
    public function getCia()
    {
        return $this->cia;
    }

    /**
     * Set tipoDoc
     *
     * @param string $tipoDoc
     *
     * @return FtFacturaProveedor
     */
    public function setTipoDoc($tipoDoc)
    {
        $this->tipoDoc = $tipoDoc;

        return $this;
    }

    /**
     * Get tipoDoc
     *
     * @return string
     */
    public function getTipoDoc()
    {
        return $this->tipoDoc;
    }

    /**
     * Set fechaExp
     *
     * @param \DateTime $fechaExp
     *
     * @return FtFacturaProveedor
     */
    public function setFechaExp($fechaExp)
    {
        $this->fechaExp = $fechaExp;

        return $this;
    }

    /**
     * Get fechaExp
     *
     * @return \DateTime
     */
    public function getFechaExp()
    {
        return $this->fechaExp;
    }

    /**
     * Set fechaVenc
     *
     * @param \DateTime $fechaVenc
     *
     * @return FtFacturaProveedor
     */
    public function setFechaVenc($fechaVenc)
    {
        $this->fechaVenc = $fechaVenc;

        return $this;
    }

    /**
     * Get fechaVenc
     *
     * @return \DateTime
     */
    public function getFechaVenc()
    {
        return $this->fechaVenc;
    }

    /**
     * Set numFactura
     *
     * @param string $numFactura
     *
     * @return FtFacturaProveedor
     */
    public function setNumFactura($numFactura)
    {
        $this->numFactura = $numFactura;

        return $this;
    }

    /**
     * Get numFactura
     *
     * @return string
     */
    public function getNumFactura()
    {
        return $this->numFactura;
    }

    /**
     * Set prooveedor
     *
     * @param string $prooveedor
     *
     * @return FtFacturaProveedor
     */
    public function setProoveedor($prooveedor)
    {
        $this->prooveedor = $prooveedor;

        return $this;
    }

    /**
     * Get prooveedor
     *
     * @return string
     */
    public function getProoveedor()
    {
        return $this->prooveedor;
    }

    /**
     * Set tipoMoneda
     *
     * @param integer $tipoMoneda
     *
     * @return FtFacturaProveedor
     */
    public function setTipoMoneda($tipoMoneda)
    {
        $this->tipoMoneda = $tipoMoneda;

        return $this;
    }

    /**
     * Get tipoMoneda
     *
     * @return integer
     */
    public function getTipoMoneda()
    {
        return $this->tipoMoneda;
    }

    /**
     * Set enviar
     *
     * @param string $enviar
     *
     * @return FtFacturaProveedor
     */
    public function setEnviar($enviar)
    {
        $this->enviar = $enviar;

        return $this;
    }

    /**
     * Get enviar
     *
     * @return string
     */
    public function getEnviar()
    {
        return $this->enviar;
    }

    /**
     * Set fechaFactura
     *
     * @param \DateTime $fechaFactura
     *
     * @return FtFacturaProveedor
     */
    public function setFechaFactura($fechaFactura)
    {
        $this->fechaFactura = $fechaFactura;

        return $this;
    }

    /**
     * Get fechaFactura
     *
     * @return \DateTime
     */
    public function getFechaFactura()
    {
        return $this->fechaFactura;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtFacturaProveedor
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
     * Set caja
     *
     * @param integer $caja
     *
     * @return FtFacturaProveedor
     */
    public function setCaja($caja)
    {
        $this->caja = $caja;

        return $this;
    }

    /**
     * Get caja
     *
     * @return integer
     */
    public function getCaja()
    {
        return $this->caja;
    }

    /**
     * Set unidadDocumenta
     *
     * @param string $unidadDocumenta
     *
     * @return FtFacturaProveedor
     */
    public function setUnidadDocumenta($unidadDocumenta)
    {
        $this->unidadDocumenta = $unidadDocumenta;

        return $this;
    }

    /**
     * Get unidadDocumenta
     *
     * @return string
     */
    public function getUnidadDocumenta()
    {
        return $this->unidadDocumenta;
    }

    /**
     * Set requiereIrecibo
     *
     * @param integer $requiereIrecibo
     *
     * @return FtFacturaProveedor
     */
    public function setRequiereIrecibo($requiereIrecibo)
    {
        $this->requiereIrecibo = $requiereIrecibo;

        return $this;
    }

    /**
     * Get requiereIrecibo
     *
     * @return integer
     */
    public function getRequiereIrecibo()
    {
        return $this->requiereIrecibo;
    }

    /**
     * Set numeroGuia
     *
     * @param string $numeroGuia
     *
     * @return FtFacturaProveedor
     */
    public function setNumeroGuia($numeroGuia)
    {
        $this->numeroGuia = $numeroGuia;

        return $this;
    }

    /**
     * Get numeroGuia
     *
     * @return string
     */
    public function getNumeroGuia()
    {
        return $this->numeroGuia;
    }

    /**
     * Set empresaGuia
     *
     * @param string $empresaGuia
     *
     * @return FtFacturaProveedor
     */
    public function setEmpresaGuia($empresaGuia)
    {
        $this->empresaGuia = $empresaGuia;

        return $this;
    }

    /**
     * Get empresaGuia
     *
     * @return string
     */
    public function getEmpresaGuia()
    {
        return $this->empresaGuia;
    }

    /**
     * Set ordenCompra
     *
     * @param string $ordenCompra
     *
     * @return FtFacturaProveedor
     */
    public function setOrdenCompra($ordenCompra)
    {
        $this->ordenCompra = $ordenCompra;

        return $this;
    }

    /**
     * Get ordenCompra
     *
     * @return string
     */
    public function getOrdenCompra()
    {
        return $this->ordenCompra;
    }

    /**
     * Set archivoUbicacion
     *
     * @param string $archivoUbicacion
     *
     * @return FtFacturaProveedor
     */
    public function setArchivoUbicacion($archivoUbicacion)
    {
        $this->archivoUbicacion = $archivoUbicacion;

        return $this;
    }

    /**
     * Get archivoUbicacion
     *
     * @return string
     */
    public function getArchivoUbicacion()
    {
        return $this->archivoUbicacion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtFacturaProveedor
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
     * @return FtFacturaProveedor
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
     * @return FtFacturaProveedor
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
     * @return FtFacturaProveedor
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
     * Set valorFactura
     *
     * @param string $valorFactura
     *
     * @return FtFacturaProveedor
     */
    public function setValorFactura($valorFactura)
    {
        $this->valorFactura = $valorFactura;

        return $this;
    }

    /**
     * Get valorFactura
     *
     * @return string
     */
    public function getValorFactura()
    {
        return $this->valorFactura;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtFacturaProveedor
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

