<?php

namespace Saia;

/**
 * FtReadh
 */
class FtReadh
{
    /**
     * @var integer
     */
    private $idftReadh;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $tipoEntidad;

    /**
     * @var integer
     */
    private $enfoqueDiferencial;

    /**
     * @var integer
     */
    private $ubicacionGeografica;

    /**
     * @var integer
     */
    private $nombreEntidad;

    /**
     * @var string
     */
    private $nombreParalelo;

    /**
     * @var string
     */
    private $descripcionReadh;

    /**
     * @var string
     */
    private $contextoGeografico;

    /**
     * @var integer
     */
    private $registroFunciones;

    /**
     * @var integer
     */
    private $estadoRegistro;

    /**
     * @var integer
     */
    private $palabrasClave;

    /**
     * @var string
     */
    private $anexosDigitales;

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
     * Get idftReadh
     *
     * @return integer
     */
    public function getIdftReadh()
    {
        return $this->idftReadh;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtReadh
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
     * Set tipoEntidad
     *
     * @param integer $tipoEntidad
     *
     * @return FtReadh
     */
    public function setTipoEntidad($tipoEntidad)
    {
        $this->tipoEntidad = $tipoEntidad;

        return $this;
    }

    /**
     * Get tipoEntidad
     *
     * @return integer
     */
    public function getTipoEntidad()
    {
        return $this->tipoEntidad;
    }

    /**
     * Set enfoqueDiferencial
     *
     * @param integer $enfoqueDiferencial
     *
     * @return FtReadh
     */
    public function setEnfoqueDiferencial($enfoqueDiferencial)
    {
        $this->enfoqueDiferencial = $enfoqueDiferencial;

        return $this;
    }

    /**
     * Get enfoqueDiferencial
     *
     * @return integer
     */
    public function getEnfoqueDiferencial()
    {
        return $this->enfoqueDiferencial;
    }

    /**
     * Set ubicacionGeografica
     *
     * @param integer $ubicacionGeografica
     *
     * @return FtReadh
     */
    public function setUbicacionGeografica($ubicacionGeografica)
    {
        $this->ubicacionGeografica = $ubicacionGeografica;

        return $this;
    }

    /**
     * Get ubicacionGeografica
     *
     * @return integer
     */
    public function getUbicacionGeografica()
    {
        return $this->ubicacionGeografica;
    }

    /**
     * Set nombreEntidad
     *
     * @param integer $nombreEntidad
     *
     * @return FtReadh
     */
    public function setNombreEntidad($nombreEntidad)
    {
        $this->nombreEntidad = $nombreEntidad;

        return $this;
    }

    /**
     * Get nombreEntidad
     *
     * @return integer
     */
    public function getNombreEntidad()
    {
        return $this->nombreEntidad;
    }

    /**
     * Set nombreParalelo
     *
     * @param string $nombreParalelo
     *
     * @return FtReadh
     */
    public function setNombreParalelo($nombreParalelo)
    {
        $this->nombreParalelo = $nombreParalelo;

        return $this;
    }

    /**
     * Get nombreParalelo
     *
     * @return string
     */
    public function getNombreParalelo()
    {
        return $this->nombreParalelo;
    }

    /**
     * Set descripcionReadh
     *
     * @param string $descripcionReadh
     *
     * @return FtReadh
     */
    public function setDescripcionReadh($descripcionReadh)
    {
        $this->descripcionReadh = $descripcionReadh;

        return $this;
    }

    /**
     * Get descripcionReadh
     *
     * @return string
     */
    public function getDescripcionReadh()
    {
        return $this->descripcionReadh;
    }

    /**
     * Set contextoGeografico
     *
     * @param string $contextoGeografico
     *
     * @return FtReadh
     */
    public function setContextoGeografico($contextoGeografico)
    {
        $this->contextoGeografico = $contextoGeografico;

        return $this;
    }

    /**
     * Get contextoGeografico
     *
     * @return string
     */
    public function getContextoGeografico()
    {
        return $this->contextoGeografico;
    }

    /**
     * Set registroFunciones
     *
     * @param integer $registroFunciones
     *
     * @return FtReadh
     */
    public function setRegistroFunciones($registroFunciones)
    {
        $this->registroFunciones = $registroFunciones;

        return $this;
    }

    /**
     * Get registroFunciones
     *
     * @return integer
     */
    public function getRegistroFunciones()
    {
        return $this->registroFunciones;
    }

    /**
     * Set estadoRegistro
     *
     * @param integer $estadoRegistro
     *
     * @return FtReadh
     */
    public function setEstadoRegistro($estadoRegistro)
    {
        $this->estadoRegistro = $estadoRegistro;

        return $this;
    }

    /**
     * Get estadoRegistro
     *
     * @return integer
     */
    public function getEstadoRegistro()
    {
        return $this->estadoRegistro;
    }

    /**
     * Set palabrasClave
     *
     * @param integer $palabrasClave
     *
     * @return FtReadh
     */
    public function setPalabrasClave($palabrasClave)
    {
        $this->palabrasClave = $palabrasClave;

        return $this;
    }

    /**
     * Get palabrasClave
     *
     * @return integer
     */
    public function getPalabrasClave()
    {
        return $this->palabrasClave;
    }

    /**
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtReadh
     */
    public function setAnexosDigitales($anexosDigitales)
    {
        $this->anexosDigitales = $anexosDigitales;

        return $this;
    }

    /**
     * Get anexosDigitales
     *
     * @return string
     */
    public function getAnexosDigitales()
    {
        return $this->anexosDigitales;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtReadh
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
     * @return FtReadh
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
     * @return FtReadh
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
     * @return FtReadh
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
     * @return FtReadh
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

