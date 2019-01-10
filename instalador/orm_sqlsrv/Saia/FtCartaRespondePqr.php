<?php

namespace Saia;

/**
 * FtCartaRespondePqr
 */
class FtCartaRespondePqr
{
    /**
     * @var integer
     */
    private $idftCartaRespondePqr;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $ftPqr;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string
     */
    private $contenido;

    /**
     * @var string
     */
    private $copia;

    /**
     * @var string
     */
    private $copiaInterna;

    /**
     * @var string
     */
    private $despedida;

    /**
     * @var string
     */
    private $destinos;

    /**
     * @var string
     */
    private $iniciales;

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
    private $saludo;

    /**
     * @var \DateTime
     */
    private $fechaCartaRespuesta;

    /**
     * @var string
     */
    private $firmaExterna;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftCartaRespondePqr
     *
     * @return integer
     */
    public function getIdftCartaRespondePqr()
    {
        return $this->idftCartaRespondePqr;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtCartaRespondePqr
     */
    public function setAnexoFormato($anexoFormato)
    {
        $this->anexoFormato = $anexoFormato;

        return $this;
    }

    /**
     * Get anexoFormato
     *
     * @return string
     */
    public function getAnexoFormato()
    {
        return $this->anexoFormato;
    }

    /**
     * Set ftPqr
     *
     * @param integer $ftPqr
     *
     * @return FtCartaRespondePqr
     */
    public function setFtPqr($ftPqr)
    {
        $this->ftPqr = $ftPqr;

        return $this;
    }

    /**
     * Get ftPqr
     *
     * @return integer
     */
    public function getFtPqr()
    {
        return $this->ftPqr;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCartaRespondePqr
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtCartaRespondePqr
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
     * Set contenido
     *
     * @param string $contenido
     *
     * @return FtCartaRespondePqr
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set copia
     *
     * @param string $copia
     *
     * @return FtCartaRespondePqr
     */
    public function setCopia($copia)
    {
        $this->copia = $copia;

        return $this;
    }

    /**
     * Get copia
     *
     * @return string
     */
    public function getCopia()
    {
        return $this->copia;
    }

    /**
     * Set copiaInterna
     *
     * @param string $copiaInterna
     *
     * @return FtCartaRespondePqr
     */
    public function setCopiaInterna($copiaInterna)
    {
        $this->copiaInterna = $copiaInterna;

        return $this;
    }

    /**
     * Get copiaInterna
     *
     * @return string
     */
    public function getCopiaInterna()
    {
        return $this->copiaInterna;
    }

    /**
     * Set despedida
     *
     * @param string $despedida
     *
     * @return FtCartaRespondePqr
     */
    public function setDespedida($despedida)
    {
        $this->despedida = $despedida;

        return $this;
    }

    /**
     * Get despedida
     *
     * @return string
     */
    public function getDespedida()
    {
        return $this->despedida;
    }

    /**
     * Set destinos
     *
     * @param string $destinos
     *
     * @return FtCartaRespondePqr
     */
    public function setDestinos($destinos)
    {
        $this->destinos = $destinos;

        return $this;
    }

    /**
     * Get destinos
     *
     * @return string
     */
    public function getDestinos()
    {
        return $this->destinos;
    }

    /**
     * Set iniciales
     *
     * @param string $iniciales
     *
     * @return FtCartaRespondePqr
     */
    public function setIniciales($iniciales)
    {
        $this->iniciales = $iniciales;

        return $this;
    }

    /**
     * Get iniciales
     *
     * @return string
     */
    public function getIniciales()
    {
        return $this->iniciales;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtCartaRespondePqr
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
     * @return FtCartaRespondePqr
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
     * @return FtCartaRespondePqr
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
     * @return FtCartaRespondePqr
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
     * Set saludo
     *
     * @param string $saludo
     *
     * @return FtCartaRespondePqr
     */
    public function setSaludo($saludo)
    {
        $this->saludo = $saludo;

        return $this;
    }

    /**
     * Get saludo
     *
     * @return string
     */
    public function getSaludo()
    {
        return $this->saludo;
    }

    /**
     * Set fechaCartaRespuesta
     *
     * @param \DateTime $fechaCartaRespuesta
     *
     * @return FtCartaRespondePqr
     */
    public function setFechaCartaRespuesta($fechaCartaRespuesta)
    {
        $this->fechaCartaRespuesta = $fechaCartaRespuesta;

        return $this;
    }

    /**
     * Get fechaCartaRespuesta
     *
     * @return \DateTime
     */
    public function getFechaCartaRespuesta()
    {
        return $this->fechaCartaRespuesta;
    }

    /**
     * Set firmaExterna
     *
     * @param string $firmaExterna
     *
     * @return FtCartaRespondePqr
     */
    public function setFirmaExterna($firmaExterna)
    {
        $this->firmaExterna = $firmaExterna;

        return $this;
    }

    /**
     * Get firmaExterna
     *
     * @return string
     */
    public function getFirmaExterna()
    {
        return $this->firmaExterna;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtCartaRespondePqr
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

