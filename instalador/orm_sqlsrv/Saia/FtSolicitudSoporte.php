<?php

namespace Saia;

/**
 * FtSolicitudSoporte
 */
class FtSolicitudSoporte
{
    /**
     * @var integer
     */
    private $idftSolicitudSoporte;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var string
     */
    private $anexos;

    /**
     * @var string
     */
    private $tipoSolitud;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaSoporte;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var \DateTime
     */
    private $horaSolicitud;

    /**
     * @var integer
     */
    private $prioridad;

    /**
     * @var integer
     */
    private $arbolFuns;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftSolicitudSoporte
     *
     * @return integer
     */
    public function getIdftSolicitudSoporte()
    {
        return $this->idftSolicitudSoporte;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtSolicitudSoporte
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
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtSolicitudSoporte
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
     * Set tipoSolitud
     *
     * @param string $tipoSolitud
     *
     * @return FtSolicitudSoporte
     */
    public function setTipoSolitud($tipoSolitud)
    {
        $this->tipoSolitud = $tipoSolitud;

        return $this;
    }

    /**
     * Get tipoSolitud
     *
     * @return string
     */
    public function getTipoSolitud()
    {
        return $this->tipoSolitud;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtSolicitudSoporte
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
     * Set fechaSoporte
     *
     * @param \DateTime $fechaSoporte
     *
     * @return FtSolicitudSoporte
     */
    public function setFechaSoporte($fechaSoporte)
    {
        $this->fechaSoporte = $fechaSoporte;

        return $this;
    }

    /**
     * Get fechaSoporte
     *
     * @return \DateTime
     */
    public function getFechaSoporte()
    {
        return $this->fechaSoporte;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudSoporte
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudSoporte
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtSolicitudSoporte
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
     * @return FtSolicitudSoporte
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
     * Set horaSolicitud
     *
     * @param \DateTime $horaSolicitud
     *
     * @return FtSolicitudSoporte
     */
    public function setHoraSolicitud($horaSolicitud)
    {
        $this->horaSolicitud = $horaSolicitud;

        return $this;
    }

    /**
     * Get horaSolicitud
     *
     * @return \DateTime
     */
    public function getHoraSolicitud()
    {
        return $this->horaSolicitud;
    }

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     *
     * @return FtSolicitudSoporte
     */
    public function setPrioridad($prioridad)
    {
        $this->prioridad = $prioridad;

        return $this;
    }

    /**
     * Get prioridad
     *
     * @return integer
     */
    public function getPrioridad()
    {
        return $this->prioridad;
    }

    /**
     * Set arbolFuns
     *
     * @param integer $arbolFuns
     *
     * @return FtSolicitudSoporte
     */
    public function setArbolFuns($arbolFuns)
    {
        $this->arbolFuns = $arbolFuns;

        return $this;
    }

    /**
     * Get arbolFuns
     *
     * @return integer
     */
    public function getArbolFuns()
    {
        return $this->arbolFuns;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSolicitudSoporte
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

