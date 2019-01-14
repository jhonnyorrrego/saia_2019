<?php

namespace Saia;

/**
 * FtHijoPrueba
 */
class FtHijoPrueba
{
    /**
     * @var integer
     */
    private $idftHijoPrueba;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $miCampo;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $estadoDocumento;

    /**
     * @var integer
     */
    private $ftPruebaConfirApru;


    /**
     * Get idftHijoPrueba
     *
     * @return integer
     */
    public function getIdftHijoPrueba()
    {
        return $this->idftHijoPrueba;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtHijoPrueba
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtHijoPrueba
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtHijoPrueba
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
     * @return FtHijoPrueba
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
     * Set miCampo
     *
     * @param string $miCampo
     *
     * @return FtHijoPrueba
     */
    public function setMiCampo($miCampo)
    {
        $this->miCampo = $miCampo;

        return $this;
    }

    /**
     * Get miCampo
     *
     * @return string
     */
    public function getMiCampo()
    {
        return $this->miCampo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtHijoPrueba
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
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtHijoPrueba
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }

    /**
     * Set ftPruebaConfirApru
     *
     * @param integer $ftPruebaConfirApru
     *
     * @return FtHijoPrueba
     */
    public function setFtPruebaConfirApru($ftPruebaConfirApru)
    {
        $this->ftPruebaConfirApru = $ftPruebaConfirApru;

        return $this;
    }

    /**
     * Get ftPruebaConfirApru
     *
     * @return integer
     */
    public function getFtPruebaConfirApru()
    {
        return $this->ftPruebaConfirApru;
    }
}

