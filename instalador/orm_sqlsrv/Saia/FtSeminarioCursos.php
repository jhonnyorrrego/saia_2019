<?php

namespace Saia;

/**
 * FtSeminarioCursos
 */
class FtSeminarioCursos
{
    /**
     * @var integer
     */
    private $idftSeminarioCursos;

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
    private $nombre;

    /**
     * @var integer
     */
    private $tipoSeminario;

    /**
     * @var string
     */
    private $tituloSeminario;

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
     * Get idftSeminarioCursos
     *
     * @return integer
     */
    public function getIdftSeminarioCursos()
    {
        return $this->idftSeminarioCursos;
    }

    /**
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtSeminarioCursos
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
     * Set tipoSeminario
     *
     * @param integer $tipoSeminario
     *
     * @return FtSeminarioCursos
     */
    public function setTipoSeminario($tipoSeminario)
    {
        $this->tipoSeminario = $tipoSeminario;

        return $this;
    }

    /**
     * Get tipoSeminario
     *
     * @return integer
     */
    public function getTipoSeminario()
    {
        return $this->tipoSeminario;
    }

    /**
     * Set tituloSeminario
     *
     * @param string $tituloSeminario
     *
     * @return FtSeminarioCursos
     */
    public function setTituloSeminario($tituloSeminario)
    {
        $this->tituloSeminario = $tituloSeminario;

        return $this;
    }

    /**
     * Get tituloSeminario
     *
     * @return string
     */
    public function getTituloSeminario()
    {
        return $this->tituloSeminario;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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
     * @return FtSeminarioCursos
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

