<?php

namespace Saia;

/**
 * FtContratoRegistroCliente
 */
class FtContratoRegistroCliente
{
    /**
     * @var integer
     */
    private $idftContratoRegistroCliente;

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
     * @var string
     */
    private $objetoContrato;

    /**
     * @var \DateTime
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     */
    private $fechaFin;

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
     * Get idftContratoRegistroCliente
     *
     * @return integer
     */
    public function getIdftContratoRegistroCliente()
    {
        return $this->idftContratoRegistroCliente;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtContratoRegistroCliente
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
     * @return FtContratoRegistroCliente
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
     * @return FtContratoRegistroCliente
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
     * Set objetoContrato
     *
     * @param string $objetoContrato
     *
     * @return FtContratoRegistroCliente
     */
    public function setObjetoContrato($objetoContrato)
    {
        $this->objetoContrato = $objetoContrato;

        return $this;
    }

    /**
     * Get objetoContrato
     *
     * @return string
     */
    public function getObjetoContrato()
    {
        return $this->objetoContrato;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return FtContratoRegistroCliente
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return FtContratoRegistroCliente
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtContratoRegistroCliente
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
     * @return FtContratoRegistroCliente
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
     * @return FtContratoRegistroCliente
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
     * @return FtContratoRegistroCliente
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
     * @return FtContratoRegistroCliente
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
     * @return FtContratoRegistroCliente
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

