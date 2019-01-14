<?php

namespace Saia;

/**
 * FtNotificacionInterna
 */
class FtNotificacionInterna
{
    /**
     * @var integer
     */
    private $idftNotificacionInterna;

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
    private $copiaA;

    /**
     * @var string
     */
    private $destino;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $saludo;

    /**
     * @var string
     */
    private $despedida;

    /**
     * @var integer
     */
    private $dependencia;

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
    private $iniciales;

    /**
     * @var string
     */
    private $anexosFisicos;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $origen;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftNotificacionInterna
     *
     * @return integer
     */
    public function getIdftNotificacionInterna()
    {
        return $this->idftNotificacionInterna;
    }

    /**
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtNotificacionInterna
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
     * @return FtNotificacionInterna
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
     * Set copiaA
     *
     * @param string $copiaA
     *
     * @return FtNotificacionInterna
     */
    public function setCopiaA($copiaA)
    {
        $this->copiaA = $copiaA;

        return $this;
    }

    /**
     * Get copiaA
     *
     * @return string
     */
    public function getCopiaA()
    {
        return $this->copiaA;
    }

    /**
     * Set destino
     *
     * @param string $destino
     *
     * @return FtNotificacionInterna
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtNotificacionInterna
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set saludo
     *
     * @param string $saludo
     *
     * @return FtNotificacionInterna
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
     * Set despedida
     *
     * @param string $despedida
     *
     * @return FtNotificacionInterna
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtNotificacionInterna
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
     * @return FtNotificacionInterna
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
     * @return FtNotificacionInterna
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
     * @return FtNotificacionInterna
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
     * Set iniciales
     *
     * @param string $iniciales
     *
     * @return FtNotificacionInterna
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
     * @return FtNotificacionInterna
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtNotificacionInterna
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtNotificacionInterna
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
     * Set origen
     *
     * @param integer $origen
     *
     * @return FtNotificacionInterna
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return integer
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
     * @return FtNotificacionInterna
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

