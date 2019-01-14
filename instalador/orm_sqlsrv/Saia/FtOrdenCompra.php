<?php

namespace Saia;

/**
 * FtOrdenCompra
 */
class FtOrdenCompra
{
    /**
     * @var integer
     */
    private $idftOrdenCompra;

    /**
     * @var integer
     */
    private $ftEvaluacionProveedores;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var \DateTime
     */
    private $fechaEntrega;

    /**
     * @var \DateTime
     */
    private $fechaOrdenCompra;

    /**
     * @var string
     */
    private $lugarEntrega;

    /**
     * @var string
     */
    private $observaciones;

    /**
     * @var string
     */
    private $origenRecursos;

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
     * Get idftOrdenCompra
     *
     * @return integer
     */
    public function getIdftOrdenCompra()
    {
        return $this->idftOrdenCompra;
    }

    /**
     * Set ftEvaluacionProveedores
     *
     * @param integer $ftEvaluacionProveedores
     *
     * @return FtOrdenCompra
     */
    public function setFtEvaluacionProveedores($ftEvaluacionProveedores)
    {
        $this->ftEvaluacionProveedores = $ftEvaluacionProveedores;

        return $this;
    }

    /**
     * Get ftEvaluacionProveedores
     *
     * @return integer
     */
    public function getFtEvaluacionProveedores()
    {
        return $this->ftEvaluacionProveedores;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtOrdenCompra
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
     * Set fechaEntrega
     *
     * @param \DateTime $fechaEntrega
     *
     * @return FtOrdenCompra
     */
    public function setFechaEntrega($fechaEntrega)
    {
        $this->fechaEntrega = $fechaEntrega;

        return $this;
    }

    /**
     * Get fechaEntrega
     *
     * @return \DateTime
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * Set fechaOrdenCompra
     *
     * @param \DateTime $fechaOrdenCompra
     *
     * @return FtOrdenCompra
     */
    public function setFechaOrdenCompra($fechaOrdenCompra)
    {
        $this->fechaOrdenCompra = $fechaOrdenCompra;

        return $this;
    }

    /**
     * Get fechaOrdenCompra
     *
     * @return \DateTime
     */
    public function getFechaOrdenCompra()
    {
        return $this->fechaOrdenCompra;
    }

    /**
     * Set lugarEntrega
     *
     * @param string $lugarEntrega
     *
     * @return FtOrdenCompra
     */
    public function setLugarEntrega($lugarEntrega)
    {
        $this->lugarEntrega = $lugarEntrega;

        return $this;
    }

    /**
     * Get lugarEntrega
     *
     * @return string
     */
    public function getLugarEntrega()
    {
        return $this->lugarEntrega;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtOrdenCompra
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
     * Set origenRecursos
     *
     * @param string $origenRecursos
     *
     * @return FtOrdenCompra
     */
    public function setOrigenRecursos($origenRecursos)
    {
        $this->origenRecursos = $origenRecursos;

        return $this;
    }

    /**
     * Get origenRecursos
     *
     * @return string
     */
    public function getOrigenRecursos()
    {
        return $this->origenRecursos;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtOrdenCompra
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
     * @return FtOrdenCompra
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
     * @return FtOrdenCompra
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
     * @return FtOrdenCompra
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
     * @return FtOrdenCompra
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

