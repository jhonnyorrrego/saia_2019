<?php

namespace Saia;

/**
 * FtNovedadesServicio
 */
class FtNovedadesServicio
{
    /**
     * @var integer
     */
    private $idftNovedadesServicio;

    /**
     * @var integer
     */
    private $ftVerificaInformacion;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var string
     */
    private $anexosFisicos;

    /**
     * @var string
     */
    private $asunto;

    /**
     * @var string
     */
    private $codigo;

    /**
     * @var string
     */
    private $copia;

    /**
     * @var string
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
    private $fechaCreacion;

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
    private $saludo;

    /**
     * @var integer
     */
    private $variosRadicados;

    /**
     * @var string
     */
    private $vercopiainterna;

    /**
     * @var integer
     */
    private $tipoMensajeria;

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
    private $estadoDocumento;


    /**
     * Get idftNovedadesServicio
     *
     * @return integer
     */
    public function getIdftNovedadesServicio()
    {
        return $this->idftNovedadesServicio;
    }

    /**
     * Set ftVerificaInformacion
     *
     * @param integer $ftVerificaInformacion
     *
     * @return FtNovedadesServicio
     */
    public function setFtVerificaInformacion($ftVerificaInformacion)
    {
        $this->ftVerificaInformacion = $ftVerificaInformacion;

        return $this;
    }

    /**
     * Get ftVerificaInformacion
     *
     * @return integer
     */
    public function getFtVerificaInformacion()
    {
        return $this->ftVerificaInformacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtNovedadesServicio
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtNovedadesServicio
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
     * Set anexosFisicos
     *
     * @param string $anexosFisicos
     *
     * @return FtNovedadesServicio
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return FtNovedadesServicio
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
     * Set codigo
     *
     * @param string $codigo
     *
     * @return FtNovedadesServicio
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set copia
     *
     * @param string $copia
     *
     * @return FtNovedadesServicio
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
     * @param string $copiainterna
     *
     * @return FtNovedadesServicio
     */
    public function setCopiainterna($copiainterna)
    {
        $this->copiainterna = $copiainterna;

        return $this;
    }

    /**
     * Get copiainterna
     *
     * @return string
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
     * @return FtNovedadesServicio
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
     * @return FtNovedadesServicio
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
     * Set fechaCreacion
     *
     * @param \DateTime $fechaCreacion
     *
     * @return FtNovedadesServicio
     */
    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;

        return $this;
    }

    /**
     * Get fechaCreacion
     *
     * @return \DateTime
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtNovedadesServicio
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
     * @return FtNovedadesServicio
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
     * Set saludo
     *
     * @param string $saludo
     *
     * @return FtNovedadesServicio
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
     * Set variosRadicados
     *
     * @param integer $variosRadicados
     *
     * @return FtNovedadesServicio
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
     * Set vercopiainterna
     *
     * @param string $vercopiainterna
     *
     * @return FtNovedadesServicio
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
     * Set tipoMensajeria
     *
     * @param integer $tipoMensajeria
     *
     * @return FtNovedadesServicio
     */
    public function setTipoMensajeria($tipoMensajeria)
    {
        $this->tipoMensajeria = $tipoMensajeria;

        return $this;
    }

    /**
     * Get tipoMensajeria
     *
     * @return integer
     */
    public function getTipoMensajeria()
    {
        return $this->tipoMensajeria;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtNovedadesServicio
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
     * @return FtNovedadesServicio
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
     * @return FtNovedadesServicio
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtNovedadesServicio
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

