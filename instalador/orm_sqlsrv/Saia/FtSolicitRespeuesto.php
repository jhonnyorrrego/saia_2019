<?php

namespace Saia;

/**
 * FtSolicitRespeuesto
 */
class FtSolicitRespeuesto
{
    /**
     * @var integer
     */
    private $idftSolicitRespeuesto;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $ftClasifSolicitud;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaRepuesto;

    /**
     * @var string
     */
    private $repuesto;

    /**
     * @var integer
     */
    private $cantidad;

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
     * Get idftSolicitRespeuesto
     *
     * @return integer
     */
    public function getIdftSolicitRespeuesto()
    {
        return $this->idftSolicitRespeuesto;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSolicitRespeuesto
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
     * Set ftClasifSolicitud
     *
     * @param integer $ftClasifSolicitud
     *
     * @return FtSolicitRespeuesto
     */
    public function setFtClasifSolicitud($ftClasifSolicitud)
    {
        $this->ftClasifSolicitud = $ftClasifSolicitud;

        return $this;
    }

    /**
     * Get ftClasifSolicitud
     *
     * @return integer
     */
    public function getFtClasifSolicitud()
    {
        return $this->ftClasifSolicitud;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitRespeuesto
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
     * Set fechaRepuesto
     *
     * @param \DateTime $fechaRepuesto
     *
     * @return FtSolicitRespeuesto
     */
    public function setFechaRepuesto($fechaRepuesto)
    {
        $this->fechaRepuesto = $fechaRepuesto;

        return $this;
    }

    /**
     * Get fechaRepuesto
     *
     * @return \DateTime
     */
    public function getFechaRepuesto()
    {
        return $this->fechaRepuesto;
    }

    /**
     * Set repuesto
     *
     * @param string $repuesto
     *
     * @return FtSolicitRespeuesto
     */
    public function setRepuesto($repuesto)
    {
        $this->repuesto = $repuesto;

        return $this;
    }

    /**
     * Get repuesto
     *
     * @return string
     */
    public function getRepuesto()
    {
        return $this->repuesto;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return FtSolicitRespeuesto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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

