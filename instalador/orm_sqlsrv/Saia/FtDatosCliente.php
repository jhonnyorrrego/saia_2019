<?php

namespace Saia;

/**
 * FtDatosCliente
 */
class FtDatosCliente
{
    /**
     * @var integer
     */
    private $idftDatosCliente;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $datosCliente;

    /**
     * @var \DateTime
     */
    private $fechaIngresoCliente;

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
    private $observacionesCliente;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftDatosCliente
     *
     * @return integer
     */
    public function getIdftDatosCliente()
    {
        return $this->idftDatosCliente;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDatosCliente
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
     * Set datosCliente
     *
     * @param string $datosCliente
     *
     * @return FtDatosCliente
     */
    public function setDatosCliente($datosCliente)
    {
        $this->datosCliente = $datosCliente;

        return $this;
    }

    /**
     * Get datosCliente
     *
     * @return string
     */
    public function getDatosCliente()
    {
        return $this->datosCliente;
    }

    /**
     * Set fechaIngresoCliente
     *
     * @param \DateTime $fechaIngresoCliente
     *
     * @return FtDatosCliente
     */
    public function setFechaIngresoCliente($fechaIngresoCliente)
    {
        $this->fechaIngresoCliente = $fechaIngresoCliente;

        return $this;
    }

    /**
     * Get fechaIngresoCliente
     *
     * @return \DateTime
     */
    public function getFechaIngresoCliente()
    {
        return $this->fechaIngresoCliente;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDatosCliente
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
     * @return FtDatosCliente
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
     * @return FtDatosCliente
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
     * @return FtDatosCliente
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
     * Set observacionesCliente
     *
     * @param string $observacionesCliente
     *
     * @return FtDatosCliente
     */
    public function setObservacionesCliente($observacionesCliente)
    {
        $this->observacionesCliente = $observacionesCliente;

        return $this;
    }

    /**
     * Get observacionesCliente
     *
     * @return string
     */
    public function getObservacionesCliente()
    {
        return $this->observacionesCliente;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtDatosCliente
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

