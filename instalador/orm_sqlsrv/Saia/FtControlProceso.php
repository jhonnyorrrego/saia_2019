<?php

namespace Saia;

/**
 * FtControlProceso
 */
class FtControlProceso
{
    /**
     * @var integer
     */
    private $idftControlProceso;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $estado;

    /**
     * @var string
     */
    private $hojaVidaIndicador;

    /**
     * @var integer
     */
    private $ftProceso;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftControlProceso
     *
     * @return integer
     */
    public function getIdftControlProceso()
    {
        return $this->idftControlProceso;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtControlProceso
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtControlProceso
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtControlProceso
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtControlProceso
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtControlProceso
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtControlProceso
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtControlProceso
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set hojaVidaIndicador
     *
     * @param string $hojaVidaIndicador
     *
     * @return FtControlProceso
     */
    public function setHojaVidaIndicador($hojaVidaIndicador)
    {
        $this->hojaVidaIndicador = $hojaVidaIndicador;

        return $this;
    }

    /**
     * Get hojaVidaIndicador
     *
     * @return string
     */
    public function getHojaVidaIndicador()
    {
        return $this->hojaVidaIndicador;
    }

    /**
     * Set ftProceso
     *
     * @param integer $ftProceso
     *
     * @return FtControlProceso
     */
    public function setFtProceso($ftProceso)
    {
        $this->ftProceso = $ftProceso;

        return $this;
    }

    /**
     * Get ftProceso
     *
     * @return integer
     */
    public function getFtProceso()
    {
        return $this->ftProceso;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtControlProceso
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

