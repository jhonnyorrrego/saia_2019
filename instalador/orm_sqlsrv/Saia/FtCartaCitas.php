<?php

namespace Saia;

/**
 * FtCartaCitas
 */
class FtCartaCitas
{
    /**
     * @var integer
     */
    private $idftCartaCitas;

    /**
     * @var integer
     */
    private $ftCitasEjecutadas;

    /**
     * @var integer
     */
    private $serieIdserie;

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
    private $destino;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string
     */
    private $citasRemitidas;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftCartaCitas
     *
     * @return integer
     */
    public function getIdftCartaCitas()
    {
        return $this->idftCartaCitas;
    }

    /**
     * Set ftCitasEjecutadas
     *
     * @param integer $ftCitasEjecutadas
     *
     * @return FtCartaCitas
     */
    public function setFtCitasEjecutadas($ftCitasEjecutadas)
    {
        $this->ftCitasEjecutadas = $ftCitasEjecutadas;

        return $this;
    }

    /**
     * Get ftCitasEjecutadas
     *
     * @return integer
     */
    public function getFtCitasEjecutadas()
    {
        return $this->ftCitasEjecutadas;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCartaCitas
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtCartaCitas
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
     * @return FtCartaCitas
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
     * @return FtCartaCitas
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
     * @return FtCartaCitas
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
     * Set destino
     *
     * @param string $destino
     *
     * @return FtCartaCitas
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtCartaCitas
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }

    /**
     * Set citasRemitidas
     *
     * @param string $citasRemitidas
     *
     * @return FtCartaCitas
     */
    public function setCitasRemitidas($citasRemitidas)
    {
        $this->citasRemitidas = $citasRemitidas;

        return $this;
    }

    /**
     * Get citasRemitidas
     *
     * @return string
     */
    public function getCitasRemitidas()
    {
        return $this->citasRemitidas;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtCartaCitas
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

