<?php

namespace Saia;

/**
 * FtPruebaMauro2
 */
class FtPruebaMauro2
{
    /**
     * @var integer
     */
    private $idftPruebaMauro2;

    /**
     * @var integer
     */
    private $ftPruebaMauro1;

    /**
     * @var string
     */
    private $estadoDocumento;

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
    private $texto;

    /**
     * @var integer
     */
    private $usuarios;


    /**
     * Get idftPruebaMauro2
     *
     * @return integer
     */
    public function getIdftPruebaMauro2()
    {
        return $this->idftPruebaMauro2;
    }

    /**
     * Set ftPruebaMauro1
     *
     * @param integer $ftPruebaMauro1
     *
     * @return FtPruebaMauro2
     */
    public function setFtPruebaMauro1($ftPruebaMauro1)
    {
        $this->ftPruebaMauro1 = $ftPruebaMauro1;

        return $this;
    }

    /**
     * Get ftPruebaMauro1
     *
     * @return integer
     */
    public function getFtPruebaMauro1()
    {
        return $this->ftPruebaMauro1;
    }

    /**
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtPruebaMauro2
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaMauro2
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
     * @return FtPruebaMauro2
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
     * @return FtPruebaMauro2
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
     * @return FtPruebaMauro2
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
     * @return FtPruebaMauro2
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
     * Set texto
     *
     * @param string $texto
     *
     * @return FtPruebaMauro2
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;

        return $this;
    }

    /**
     * Get texto
     *
     * @return string
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set usuarios
     *
     * @param integer $usuarios
     *
     * @return FtPruebaMauro2
     */
    public function setUsuarios($usuarios)
    {
        $this->usuarios = $usuarios;

        return $this;
    }

    /**
     * Get usuarios
     *
     * @return integer
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }
}

