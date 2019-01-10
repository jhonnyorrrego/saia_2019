<?php

namespace Saia;

/**
 * FtAnexosHojaVida
 */
class FtAnexosHojaVida
{
    /**
     * @var integer
     */
    private $idftAnexosHojaVida;

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
    private $anexos;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var integer
     */
    private $estadoAnexo;

    /**
     * @var integer
     */
    private $estructuraHojaVida;

    /**
     * @var \DateTime
     */
    private $fechaVigencia;

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
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftAnexosHojaVida
     *
     * @return integer
     */
    public function getIdftAnexosHojaVida()
    {
        return $this->idftAnexosHojaVida;
    }

    /**
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtAnexosHojaVida
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
     * @return FtAnexosHojaVida
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
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtAnexosHojaVida
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtAnexosHojaVida
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
     * Set direccion
     *
     * @param string $direccion
     *
     * @return FtAnexosHojaVida
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set estadoAnexo
     *
     * @param integer $estadoAnexo
     *
     * @return FtAnexosHojaVida
     */
    public function setEstadoAnexo($estadoAnexo)
    {
        $this->estadoAnexo = $estadoAnexo;

        return $this;
    }

    /**
     * Get estadoAnexo
     *
     * @return integer
     */
    public function getEstadoAnexo()
    {
        return $this->estadoAnexo;
    }

    /**
     * Set estructuraHojaVida
     *
     * @param integer $estructuraHojaVida
     *
     * @return FtAnexosHojaVida
     */
    public function setEstructuraHojaVida($estructuraHojaVida)
    {
        $this->estructuraHojaVida = $estructuraHojaVida;

        return $this;
    }

    /**
     * Get estructuraHojaVida
     *
     * @return integer
     */
    public function getEstructuraHojaVida()
    {
        return $this->estructuraHojaVida;
    }

    /**
     * Set fechaVigencia
     *
     * @param \DateTime $fechaVigencia
     *
     * @return FtAnexosHojaVida
     */
    public function setFechaVigencia($fechaVigencia)
    {
        $this->fechaVigencia = $fechaVigencia;

        return $this;
    }

    /**
     * Get fechaVigencia
     *
     * @return \DateTime
     */
    public function getFechaVigencia()
    {
        return $this->fechaVigencia;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtAnexosHojaVida
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
     * @return FtAnexosHojaVida
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
     * @return FtAnexosHojaVida
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtAnexosHojaVida
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtAnexosHojaVida
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

