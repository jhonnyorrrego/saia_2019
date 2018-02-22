<?php

namespace Saia;

/**
 * FtRecordarTarea
 */
class FtRecordarTarea
{
    /**
     * @var integer
     */
    private $idftRecordarTarea;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $responsable;

    /**
     * @var string
     */
    private $vinculados;

    /**
     * @var string
     */
    private $tareaAsiganda;

    /**
     * @var integer
     */
    private $prioridad;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $periodicidad;

    /**
     * @var \DateTime
     */
    private $fechaEntraga;

    /**
     * @var string
     */
    private $anexos;

    /**
     * @var string
     */
    private $diasRecordar;

    /**
     * @var string
     */
    private $horasRecordar;

    /**
     * @var string
     */
    private $mesRecordar;

    /**
     * @var string
     */
    private $semanasRecordar;

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
    private $tipoPeriodo;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fechaFormato;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftRecordarTarea
     *
     * @return integer
     */
    public function getIdftRecordarTarea()
    {
        return $this->idftRecordarTarea;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRecordarTarea
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
     * Set responsable
     *
     * @param string $responsable
     *
     * @return FtRecordarTarea
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set vinculados
     *
     * @param string $vinculados
     *
     * @return FtRecordarTarea
     */
    public function setVinculados($vinculados)
    {
        $this->vinculados = $vinculados;

        return $this;
    }

    /**
     * Get vinculados
     *
     * @return string
     */
    public function getVinculados()
    {
        return $this->vinculados;
    }

    /**
     * Set tareaAsiganda
     *
     * @param string $tareaAsiganda
     *
     * @return FtRecordarTarea
     */
    public function setTareaAsiganda($tareaAsiganda)
    {
        $this->tareaAsiganda = $tareaAsiganda;

        return $this;
    }

    /**
     * Get tareaAsiganda
     *
     * @return string
     */
    public function getTareaAsiganda()
    {
        return $this->tareaAsiganda;
    }

    /**
     * Set prioridad
     *
     * @param integer $prioridad
     *
     * @return FtRecordarTarea
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FtRecordarTarea
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set periodicidad
     *
     * @param string $periodicidad
     *
     * @return FtRecordarTarea
     */
    public function setPeriodicidad($periodicidad)
    {
        $this->periodicidad = $periodicidad;

        return $this;
    }

    /**
     * Get periodicidad
     *
     * @return string
     */
    public function getPeriodicidad()
    {
        return $this->periodicidad;
    }

    /**
     * Set fechaEntraga
     *
     * @param \DateTime $fechaEntraga
     *
     * @return FtRecordarTarea
     */
    public function setFechaEntraga($fechaEntraga)
    {
        $this->fechaEntraga = $fechaEntraga;

        return $this;
    }

    /**
     * Get fechaEntraga
     *
     * @return \DateTime
     */
    public function getFechaEntraga()
    {
        return $this->fechaEntraga;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtRecordarTarea
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
     * Set diasRecordar
     *
     * @param string $diasRecordar
     *
     * @return FtRecordarTarea
     */
    public function setDiasRecordar($diasRecordar)
    {
        $this->diasRecordar = $diasRecordar;

        return $this;
    }

    /**
     * Get diasRecordar
     *
     * @return string
     */
    public function getDiasRecordar()
    {
        return $this->diasRecordar;
    }

    /**
     * Set horasRecordar
     *
     * @param string $horasRecordar
     *
     * @return FtRecordarTarea
     */
    public function setHorasRecordar($horasRecordar)
    {
        $this->horasRecordar = $horasRecordar;

        return $this;
    }

    /**
     * Get horasRecordar
     *
     * @return string
     */
    public function getHorasRecordar()
    {
        return $this->horasRecordar;
    }

    /**
     * Set mesRecordar
     *
     * @param string $mesRecordar
     *
     * @return FtRecordarTarea
     */
    public function setMesRecordar($mesRecordar)
    {
        $this->mesRecordar = $mesRecordar;

        return $this;
    }

    /**
     * Get mesRecordar
     *
     * @return string
     */
    public function getMesRecordar()
    {
        return $this->mesRecordar;
    }

    /**
     * Set semanasRecordar
     *
     * @param string $semanasRecordar
     *
     * @return FtRecordarTarea
     */
    public function setSemanasRecordar($semanasRecordar)
    {
        $this->semanasRecordar = $semanasRecordar;

        return $this;
    }

    /**
     * Get semanasRecordar
     *
     * @return string
     */
    public function getSemanasRecordar()
    {
        return $this->semanasRecordar;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRecordarTarea
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
     * @return FtRecordarTarea
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
     * @return FtRecordarTarea
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
     * @return FtRecordarTarea
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
     * Set tipoPeriodo
     *
     * @param integer $tipoPeriodo
     *
     * @return FtRecordarTarea
     */
    public function setTipoPeriodo($tipoPeriodo)
    {
        $this->tipoPeriodo = $tipoPeriodo;

        return $this;
    }

    /**
     * Get tipoPeriodo
     *
     * @return integer
     */
    public function getTipoPeriodo()
    {
        return $this->tipoPeriodo;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtRecordarTarea
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
     * Set fechaFormato
     *
     * @param \DateTime $fechaFormato
     *
     * @return FtRecordarTarea
     */
    public function setFechaFormato($fechaFormato)
    {
        $this->fechaFormato = $fechaFormato;

        return $this;
    }

    /**
     * Get fechaFormato
     *
     * @return \DateTime
     */
    public function getFechaFormato()
    {
        return $this->fechaFormato;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRecordarTarea
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

