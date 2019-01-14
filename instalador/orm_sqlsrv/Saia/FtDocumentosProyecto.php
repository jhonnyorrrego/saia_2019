<?php

namespace Saia;

/**
 * FtDocumentosProyecto
 */
class FtDocumentosProyecto
{
    /**
     * @var integer
     */
    private $idftDocumentosProyecto;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $ftProyectoRegistroCliente;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaDocumento;

    /**
     * @var string
     */
    private $tipoDocumento;

    /**
     * @var string
     */
    private $observaciones;

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
     * Get idftDocumentosProyecto
     *
     * @return integer
     */
    public function getIdftDocumentosProyecto()
    {
        return $this->idftDocumentosProyecto;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtDocumentosProyecto
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
     * Set ftProyectoRegistroCliente
     *
     * @param integer $ftProyectoRegistroCliente
     *
     * @return FtDocumentosProyecto
     */
    public function setFtProyectoRegistroCliente($ftProyectoRegistroCliente)
    {
        $this->ftProyectoRegistroCliente = $ftProyectoRegistroCliente;

        return $this;
    }

    /**
     * Get ftProyectoRegistroCliente
     *
     * @return integer
     */
    public function getFtProyectoRegistroCliente()
    {
        return $this->ftProyectoRegistroCliente;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDocumentosProyecto
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
     * Set fechaDocumento
     *
     * @param \DateTime $fechaDocumento
     *
     * @return FtDocumentosProyecto
     */
    public function setFechaDocumento($fechaDocumento)
    {
        $this->fechaDocumento = $fechaDocumento;

        return $this;
    }

    /**
     * Get fechaDocumento
     *
     * @return \DateTime
     */
    public function getFechaDocumento()
    {
        return $this->fechaDocumento;
    }

    /**
     * Set tipoDocumento
     *
     * @param string $tipoDocumento
     *
     * @return FtDocumentosProyecto
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return string
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtDocumentosProyecto
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDocumentosProyecto
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
     * @return FtDocumentosProyecto
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
     * @return FtDocumentosProyecto
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
     * @return FtDocumentosProyecto
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
     * @return FtDocumentosProyecto
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

