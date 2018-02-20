<?php

namespace Saia;

/**
 * FtMemorando
 */
class FtMemorando
{
    /**
     * @var integer
     */
    private $idftMemorando;

    /**
     * @var \DateTime
     */
    private $fechaMemorando;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var string
     */
    private $destino;

    /**
     * @var string
     */
    private $copia;

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
    private $despedida;

    /**
     * @var string
     */
    private $iniciales;

    /**
     * @var string
     */
    private $anexosFisicos;

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
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var string
     */
    private $anexos;

    /**
     * @var string
     */
    private $origen;

    /**
     * @var integer
     */
    private $estadoDocumento;

    /**
     * @var string
     */
    private $expedienteSerie;

    /**
     * @var integer
     */
    private $emailAprobar;


    /**
     * Get idftMemorando
     *
     * @return integer
     */
    public function getIdftMemorando()
    {
        return $this->idftMemorando;
    }

    /**
     * Set fechaMemorando
     *
     * @param \DateTime $fechaMemorando
     *
     * @return FtMemorando
     */
    public function setFechaMemorando($fechaMemorando)
    {
        $this->fechaMemorando = $fechaMemorando;

        return $this;
    }

    /**
     * Get fechaMemorando
     *
     * @return \DateTime
     */
    public function getFechaMemorando()
    {
        return $this->fechaMemorando;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtMemorando
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
     * Set destino
     *
     * @param string $destino
     *
     * @return FtMemorando
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set copia
     *
     * @param string $copia
     *
     * @return FtMemorando
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtMemorando
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
     * @return FtMemorando
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
     * Set despedida
     *
     * @param string $despedida
     *
     * @return FtMemorando
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
     * Set iniciales
     *
     * @param string $iniciales
     *
     * @return FtMemorando
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
     * Set anexosFisicos
     *
     * @param string $anexosFisicos
     *
     * @return FtMemorando
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtMemorando
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
     * @return FtMemorando
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtMemorando
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
     * @return FtMemorando
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
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtMemorando
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
     * Set origen
     *
     * @param string $origen
     *
     * @return FtMemorando
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return string
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtMemorando
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

    /**
     * Set expedienteSerie
     *
     * @param string $expedienteSerie
     *
     * @return FtMemorando
     */
    public function setExpedienteSerie($expedienteSerie)
    {
        $this->expedienteSerie = $expedienteSerie;

        return $this;
    }

    /**
     * Get expedienteSerie
     *
     * @return string
     */
    public function getExpedienteSerie()
    {
        return $this->expedienteSerie;
    }

    /**
     * Set emailAprobar
     *
     * @param integer $emailAprobar
     *
     * @return FtMemorando
     */
    public function setEmailAprobar($emailAprobar)
    {
        $this->emailAprobar = $emailAprobar;

        return $this;
    }

    /**
     * Get emailAprobar
     *
     * @return integer
     */
    public function getEmailAprobar()
    {
        return $this->emailAprobar;
    }
}

