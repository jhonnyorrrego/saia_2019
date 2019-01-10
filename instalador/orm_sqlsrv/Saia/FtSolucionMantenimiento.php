<?php

namespace Saia;

/**
 * FtSolucionMantenimiento
 */
class FtSolucionMantenimiento
{
    /**
     * @var integer
     */
    private $idftSolucionMantenimiento;

    /**
     * @var integer
     */
    private $ftMantenimientoLocativo;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $nombreResponsable;

    /**
     * @var string
     */
    private $descripcionSolucion;

    /**
     * @var string
     */
    private $prerequisitosMontaje;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var integer
     */
    private $anexosSolucion;

    /**
     * @var string
     */
    private $solucionDigital;

    /**
     * @var string
     */
    private $implementadoPor;

    /**
     * @var string
     */
    private $aprobacionLogistica;

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
     * Get idftSolucionMantenimiento
     *
     * @return integer
     */
    public function getIdftSolucionMantenimiento()
    {
        return $this->idftSolucionMantenimiento;
    }

    /**
     * Set ftMantenimientoLocativo
     *
     * @param integer $ftMantenimientoLocativo
     *
     * @return FtSolucionMantenimiento
     */
    public function setFtMantenimientoLocativo($ftMantenimientoLocativo)
    {
        $this->ftMantenimientoLocativo = $ftMantenimientoLocativo;

        return $this;
    }

    /**
     * Get ftMantenimientoLocativo
     *
     * @return integer
     */
    public function getFtMantenimientoLocativo()
    {
        return $this->ftMantenimientoLocativo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolucionMantenimiento
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
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FtSolucionMantenimiento
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
     * Set nombreResponsable
     *
     * @param string $nombreResponsable
     *
     * @return FtSolucionMantenimiento
     */
    public function setNombreResponsable($nombreResponsable)
    {
        $this->nombreResponsable = $nombreResponsable;

        return $this;
    }

    /**
     * Get nombreResponsable
     *
     * @return string
     */
    public function getNombreResponsable()
    {
        return $this->nombreResponsable;
    }

    /**
     * Set descripcionSolucion
     *
     * @param string $descripcionSolucion
     *
     * @return FtSolucionMantenimiento
     */
    public function setDescripcionSolucion($descripcionSolucion)
    {
        $this->descripcionSolucion = $descripcionSolucion;

        return $this;
    }

    /**
     * Get descripcionSolucion
     *
     * @return string
     */
    public function getDescripcionSolucion()
    {
        return $this->descripcionSolucion;
    }

    /**
     * Set prerequisitosMontaje
     *
     * @param string $prerequisitosMontaje
     *
     * @return FtSolucionMantenimiento
     */
    public function setPrerequisitosMontaje($prerequisitosMontaje)
    {
        $this->prerequisitosMontaje = $prerequisitosMontaje;

        return $this;
    }

    /**
     * Get prerequisitosMontaje
     *
     * @return string
     */
    public function getPrerequisitosMontaje()
    {
        return $this->prerequisitosMontaje;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtSolucionMantenimiento
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
     * Set anexosSolucion
     *
     * @param integer $anexosSolucion
     *
     * @return FtSolucionMantenimiento
     */
    public function setAnexosSolucion($anexosSolucion)
    {
        $this->anexosSolucion = $anexosSolucion;

        return $this;
    }

    /**
     * Get anexosSolucion
     *
     * @return integer
     */
    public function getAnexosSolucion()
    {
        return $this->anexosSolucion;
    }

    /**
     * Set solucionDigital
     *
     * @param string $solucionDigital
     *
     * @return FtSolucionMantenimiento
     */
    public function setSolucionDigital($solucionDigital)
    {
        $this->solucionDigital = $solucionDigital;

        return $this;
    }

    /**
     * Get solucionDigital
     *
     * @return string
     */
    public function getSolucionDigital()
    {
        return $this->solucionDigital;
    }

    /**
     * Set implementadoPor
     *
     * @param string $implementadoPor
     *
     * @return FtSolucionMantenimiento
     */
    public function setImplementadoPor($implementadoPor)
    {
        $this->implementadoPor = $implementadoPor;

        return $this;
    }

    /**
     * Get implementadoPor
     *
     * @return string
     */
    public function getImplementadoPor()
    {
        return $this->implementadoPor;
    }

    /**
     * Set aprobacionLogistica
     *
     * @param string $aprobacionLogistica
     *
     * @return FtSolucionMantenimiento
     */
    public function setAprobacionLogistica($aprobacionLogistica)
    {
        $this->aprobacionLogistica = $aprobacionLogistica;

        return $this;
    }

    /**
     * Get aprobacionLogistica
     *
     * @return string
     */
    public function getAprobacionLogistica()
    {
        return $this->aprobacionLogistica;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolucionMantenimiento
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
     * @return FtSolucionMantenimiento
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
     * @return FtSolucionMantenimiento
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
     * @return FtSolucionMantenimiento
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
     * @return FtSolucionMantenimiento
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

