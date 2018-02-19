<?php

namespace Saia;

/**
 * FtReferenciasComerciales
 */
class FtReferenciasComerciales
{
    /**
     * @var integer
     */
    private $idftReferenciasComerciales;

    /**
     * @var integer
     */
    private $ftHojaVida;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $cargoDesempeniado;

    /**
     * @var string
     */
    private $entidad;

    /**
     * @var integer
     */
    private $telefono;

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
    private $nombre;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftReferenciasComerciales
     *
     * @return integer
     */
    public function getIdftReferenciasComerciales()
    {
        return $this->idftReferenciasComerciales;
    }

    /**
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtReferenciasComerciales
     */
    public function setFtHojaVida($ftHojaVida)
    {
        $this->ftHojaVida = $ftHojaVida;

        return $this;
    }

    /**
     * Get ftHojaVida
     *
     * @return integer
     */
    public function getFtHojaVida()
    {
        return $this->ftHojaVida;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtReferenciasComerciales
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
     * Set cargoDesempeniado
     *
     * @param string $cargoDesempeniado
     *
     * @return FtReferenciasComerciales
     */
    public function setCargoDesempeniado($cargoDesempeniado)
    {
        $this->cargoDesempeniado = $cargoDesempeniado;

        return $this;
    }

    /**
     * Get cargoDesempeniado
     *
     * @return string
     */
    public function getCargoDesempeniado()
    {
        return $this->cargoDesempeniado;
    }

    /**
     * Set entidad
     *
     * @param string $entidad
     *
     * @return FtReferenciasComerciales
     */
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;

        return $this;
    }

    /**
     * Get entidad
     *
     * @return string
     */
    public function getEntidad()
    {
        return $this->entidad;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     *
     * @return FtReferenciasComerciales
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtReferenciasComerciales
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
     * @return FtReferenciasComerciales
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
     * @return FtReferenciasComerciales
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
     * @return FtReferenciasComerciales
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
     * @return FtReferenciasComerciales
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtReferenciasComerciales
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

