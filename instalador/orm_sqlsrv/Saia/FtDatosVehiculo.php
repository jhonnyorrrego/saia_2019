<?php

namespace Saia;

/**
 * FtDatosVehiculo
 */
class FtDatosVehiculo
{
    /**
     * @var integer
     */
    private $idftDatosVehiculo;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $nombreVehiculo;

    /**
     * @var integer
     */
    private $modeloVehiculo;

    /**
     * @var string
     */
    private $colorVehiculo;

    /**
     * @var string
     */
    private $serieChasisVehiculo;

    /**
     * @var integer
     */
    private $valorVehiculo;

    /**
     * @var string
     */
    private $imagenVehiculo;

    /**
     * @var string
     */
    private $motorVehiculo;

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
     * Get idftDatosVehiculo
     *
     * @return integer
     */
    public function getIdftDatosVehiculo()
    {
        return $this->idftDatosVehiculo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtDatosVehiculo
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
     * Set nombreVehiculo
     *
     * @param string $nombreVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setNombreVehiculo($nombreVehiculo)
    {
        $this->nombreVehiculo = $nombreVehiculo;

        return $this;
    }

    /**
     * Get nombreVehiculo
     *
     * @return string
     */
    public function getNombreVehiculo()
    {
        return $this->nombreVehiculo;
    }

    /**
     * Set modeloVehiculo
     *
     * @param integer $modeloVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setModeloVehiculo($modeloVehiculo)
    {
        $this->modeloVehiculo = $modeloVehiculo;

        return $this;
    }

    /**
     * Get modeloVehiculo
     *
     * @return integer
     */
    public function getModeloVehiculo()
    {
        return $this->modeloVehiculo;
    }

    /**
     * Set colorVehiculo
     *
     * @param string $colorVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setColorVehiculo($colorVehiculo)
    {
        $this->colorVehiculo = $colorVehiculo;

        return $this;
    }

    /**
     * Get colorVehiculo
     *
     * @return string
     */
    public function getColorVehiculo()
    {
        return $this->colorVehiculo;
    }

    /**
     * Set serieChasisVehiculo
     *
     * @param string $serieChasisVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setSerieChasisVehiculo($serieChasisVehiculo)
    {
        $this->serieChasisVehiculo = $serieChasisVehiculo;

        return $this;
    }

    /**
     * Get serieChasisVehiculo
     *
     * @return string
     */
    public function getSerieChasisVehiculo()
    {
        return $this->serieChasisVehiculo;
    }

    /**
     * Set valorVehiculo
     *
     * @param integer $valorVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setValorVehiculo($valorVehiculo)
    {
        $this->valorVehiculo = $valorVehiculo;

        return $this;
    }

    /**
     * Get valorVehiculo
     *
     * @return integer
     */
    public function getValorVehiculo()
    {
        return $this->valorVehiculo;
    }

    /**
     * Set imagenVehiculo
     *
     * @param string $imagenVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setImagenVehiculo($imagenVehiculo)
    {
        $this->imagenVehiculo = $imagenVehiculo;

        return $this;
    }

    /**
     * Get imagenVehiculo
     *
     * @return string
     */
    public function getImagenVehiculo()
    {
        return $this->imagenVehiculo;
    }

    /**
     * Set motorVehiculo
     *
     * @param string $motorVehiculo
     *
     * @return FtDatosVehiculo
     */
    public function setMotorVehiculo($motorVehiculo)
    {
        $this->motorVehiculo = $motorVehiculo;

        return $this;
    }

    /**
     * Get motorVehiculo
     *
     * @return string
     */
    public function getMotorVehiculo()
    {
        return $this->motorVehiculo;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtDatosVehiculo
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
     * @return FtDatosVehiculo
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
     * @return FtDatosVehiculo
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
     * @return FtDatosVehiculo
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
     * @return FtDatosVehiculo
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

