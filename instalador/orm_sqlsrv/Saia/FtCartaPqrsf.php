<?php

namespace Saia;

/**
 * FtCartaPqrsf
 */
class FtCartaPqrsf
{
    /**
     * @var integer
     */
    private $idftCartaPqrsf;

    /**
     * @var integer
     */
    private $ftPqrsf;

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
     * @var integer
     */
    private $copiainterna;

    /**
     * @var string
     */
    private $despedida;

    /**
     * @var string
     */
    private $destinos;

    /**
     * @var \DateTime
     */
    private $fechaCarta;

    /**
     * @var string
     */
    private $iniciales;

    /**
     * @var string
     */
    private $vercopiainterna;

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
    private $anexosFisicos;

    /**
     * @var integer
     */
    private $variosRadicados;

    /**
     * @var string
     */
    private $anexosDigitales;

    /**
     * @var integer
     */
    private $tipoCopiaInterna;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftCartaPqrsf
     *
     * @return integer
     */
    public function getIdftCartaPqrsf()
    {
        return $this->idftCartaPqrsf;
    }

    /**
     * Set ftPqrsf
     *
     * @param integer $ftPqrsf
     *
     * @return FtCartaPqrsf
     */
    public function setFtPqrsf($ftPqrsf)
    {
        $this->ftPqrsf = $ftPqrsf;

        return $this;
    }

    /**
     * Get ftPqrsf
     *
     * @return integer
     */
    public function getFtPqrsf()
    {
        return $this->ftPqrsf;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * Set copiainterna
     *
     * @param integer $copiainterna
     *
     * @return FtCartaPqrsf
     */
    public function setCopiainterna($copiainterna)
    {
        $this->copiainterna = $copiainterna;

        return $this;
    }

    /**
     * Get copiainterna
     *
     * @return integer
     */
    public function getCopiainterna()
    {
        return $this->copiainterna;
    }

    /**
     * Set despedida
     *
     * @param string $despedida
     *
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * Set fechaCarta
     *
     * @param \DateTime $fechaCarta
     *
     * @return FtCartaPqrsf
     */
    public function setFechaCarta($fechaCarta)
    {
        $this->fechaCarta = $fechaCarta;

        return $this;
    }

    /**
     * Get fechaCarta
     *
     * @return \DateTime
     */
    public function getFechaCarta()
    {
        return $this->fechaCarta;
    }

    /**
     * Set iniciales
     *
     * @param string $iniciales
     *
     * @return FtCartaPqrsf
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
     * Set vercopiainterna
     *
     * @param string $vercopiainterna
     *
     * @return FtCartaPqrsf
     */
    public function setVercopiainterna($vercopiainterna)
    {
        $this->vercopiainterna = $vercopiainterna;

        return $this;
    }

    /**
     * Get vercopiainterna
     *
     * @return string
     */
    public function getVercopiainterna()
    {
        return $this->vercopiainterna;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * @return FtCartaPqrsf
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
     * Set anexosFisicos
     *
     * @param string $anexosFisicos
     *
     * @return FtCartaPqrsf
     */
    public function setAnexosFisicos($anexosFisicos)
    {
        $this->anexosFisicos = $anexosFisicos;

        return $this;
    }

    /**
     * Get anexosFisicos
     *
     * @return string
     */
    public function getAnexosFisicos()
    {
        return $this->anexosFisicos;
    }

    /**
     * Set variosRadicados
     *
     * @param integer $variosRadicados
     *
     * @return FtCartaPqrsf
     */
    public function setVariosRadicados($variosRadicados)
    {
        $this->variosRadicados = $variosRadicados;

        return $this;
    }

    /**
     * Get variosRadicados
     *
     * @return integer
     */
    public function getVariosRadicados()
    {
        return $this->variosRadicados;
    }

    /**
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtCartaPqrsf
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
     * Set tipoCopiaInterna
     *
     * @param integer $tipoCopiaInterna
     *
     * @return FtCartaPqrsf
     */
    public function setTipoCopiaInterna($tipoCopiaInterna)
    {
        $this->tipoCopiaInterna = $tipoCopiaInterna;

        return $this;
    }

    /**
     * Get tipoCopiaInterna
     *
     * @return integer
     */
    public function getTipoCopiaInterna()
    {
        return $this->tipoCopiaInterna;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtCartaPqrsf
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

