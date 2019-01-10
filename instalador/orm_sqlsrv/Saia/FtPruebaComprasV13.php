<?php

namespace Saia;

/**
 * FtPruebaComprasV13
 */
class FtPruebaComprasV13
{
    /**
     * @var integer
     */
    private $idftPruebaCompras;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $estadoFormato;

    /**
     * @var string
     */
    private $arbolRadioFuncionario;

    /**
     * @var \DateTime
     */
    private $fechaSolicitud;

    /**
     * @var string
     */
    private $remitente;

    /**
     * @var string
     */
    private $tipoCompra;

    /**
     * @var string
     */
    private $cuotas;

    /**
     * @var string
     */
    private $textareaTiny155906199;

    /**
     * @var string
     */
    private $cantidad;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var string
     */
    private $anexos;


    /**
     * Get idftPruebaCompras
     *
     * @return integer
     */
    public function getIdftPruebaCompras()
    {
        return $this->idftPruebaCompras;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaComprasV13
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
     * @return FtPruebaComprasV13
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
     * @param string $dependencia
     *
     * @return FtPruebaComprasV13
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return string
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set estadoFormato
     *
     * @param integer $estadoFormato
     *
     * @return FtPruebaComprasV13
     */
    public function setEstadoFormato($estadoFormato)
    {
        $this->estadoFormato = $estadoFormato;

        return $this;
    }

    /**
     * Get estadoFormato
     *
     * @return integer
     */
    public function getEstadoFormato()
    {
        return $this->estadoFormato;
    }

    /**
     * Set arbolRadioFuncionario
     *
     * @param string $arbolRadioFuncionario
     *
     * @return FtPruebaComprasV13
     */
    public function setArbolRadioFuncionario($arbolRadioFuncionario)
    {
        $this->arbolRadioFuncionario = $arbolRadioFuncionario;

        return $this;
    }

    /**
     * Get arbolRadioFuncionario
     *
     * @return string
     */
    public function getArbolRadioFuncionario()
    {
        return $this->arbolRadioFuncionario;
    }

    /**
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     *
     * @return FtPruebaComprasV13
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set remitente
     *
     * @param string $remitente
     *
     * @return FtPruebaComprasV13
     */
    public function setRemitente($remitente)
    {
        $this->remitente = $remitente;

        return $this;
    }

    /**
     * Get remitente
     *
     * @return string
     */
    public function getRemitente()
    {
        return $this->remitente;
    }

    /**
     * Set tipoCompra
     *
     * @param string $tipoCompra
     *
     * @return FtPruebaComprasV13
     */
    public function setTipoCompra($tipoCompra)
    {
        $this->tipoCompra = $tipoCompra;

        return $this;
    }

    /**
     * Get tipoCompra
     *
     * @return string
     */
    public function getTipoCompra()
    {
        return $this->tipoCompra;
    }

    /**
     * Set cuotas
     *
     * @param string $cuotas
     *
     * @return FtPruebaComprasV13
     */
    public function setCuotas($cuotas)
    {
        $this->cuotas = $cuotas;

        return $this;
    }

    /**
     * Get cuotas
     *
     * @return string
     */
    public function getCuotas()
    {
        return $this->cuotas;
    }

    /**
     * Set textareaTiny155906199
     *
     * @param string $textareaTiny155906199
     *
     * @return FtPruebaComprasV13
     */
    public function setTextareaTiny155906199($textareaTiny155906199)
    {
        $this->textareaTiny155906199 = $textareaTiny155906199;

        return $this;
    }

    /**
     * Get textareaTiny155906199
     *
     * @return string
     */
    public function getTextareaTiny155906199()
    {
        return $this->textareaTiny155906199;
    }

    /**
     * Set cantidad
     *
     * @param string $cantidad
     *
     * @return FtPruebaComprasV13
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return string
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return FtPruebaComprasV13
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtPruebaComprasV13
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
}

