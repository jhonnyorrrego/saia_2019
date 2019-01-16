<?php

namespace Saia;

/**
 * FtEstructuraHojaVida
 */
class FtEstructuraHojaVida
{
    /**
     * @var integer
     */
    private $idftEstructuraHojaVida;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $caracteristicas;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var integer
     */
    private $codPadre;

    /**
     * @var integer
     */
    private $obligatoriedad;

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
     * Get idftEstructuraHojaVida
     *
     * @return integer
     */
    public function getIdftEstructuraHojaVida()
    {
        return $this->idftEstructuraHojaVida;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtEstructuraHojaVida
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
     * Set caracteristicas
     *
     * @param string $caracteristicas
     *
     * @return FtEstructuraHojaVida
     */
    public function setCaracteristicas($caracteristicas)
    {
        $this->caracteristicas = $caracteristicas;

        return $this;
    }

    /**
     * Get caracteristicas
     *
     * @return string
     */
    public function getCaracteristicas()
    {
        return $this->caracteristicas;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtEstructuraHojaVida
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
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return FtEstructuraHojaVida
     */
    public function setCodPadre($codPadre)
    {
        $this->codPadre = $codPadre;

        return $this;
    }

    /**
     * Get codPadre
     *
     * @return integer
     */
    public function getCodPadre()
    {
        return $this->codPadre;
    }

    /**
     * Set obligatoriedad
     *
     * @param integer $obligatoriedad
     *
     * @return FtEstructuraHojaVida
     */
    public function setObligatoriedad($obligatoriedad)
    {
        $this->obligatoriedad = $obligatoriedad;

        return $this;
    }

    /**
     * Get obligatoriedad
     *
     * @return integer
     */
    public function getObligatoriedad()
    {
        return $this->obligatoriedad;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtEstructuraHojaVida
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
     * @return FtEstructuraHojaVida
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
     * @return FtEstructuraHojaVida
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
     * @return FtEstructuraHojaVida
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
     * @return FtEstructuraHojaVida
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

