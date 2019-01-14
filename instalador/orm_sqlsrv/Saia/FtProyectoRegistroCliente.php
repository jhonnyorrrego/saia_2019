<?php

namespace Saia;

/**
 * FtProyectoRegistroCliente
 */
class FtProyectoRegistroCliente
{
    /**
     * @var integer
     */
    private $idftProyectoRegistroCliente;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var string
     */
    private $formaPago;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var integer
     */
    private $moneda;

    /**
     * @var string
     */
    private $empresaAsociada;

    /**
     * @var string
     */
    private $nombreProyecto;

    /**
     * @var string
     */
    private $duracion;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $ftRegistroCliente;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftProyectoRegistroCliente
     *
     * @return integer
     */
    public function getIdftProyectoRegistroCliente()
    {
        return $this->idftProyectoRegistroCliente;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtProyectoRegistroCliente
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
     * @return FtProyectoRegistroCliente
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
     * Set formaPago
     *
     * @param string $formaPago
     *
     * @return FtProyectoRegistroCliente
     */
    public function setFormaPago($formaPago)
    {
        $this->formaPago = $formaPago;

        return $this;
    }

    /**
     * Get formaPago
     *
     * @return string
     */
    public function getFormaPago()
    {
        return $this->formaPago;
    }

    /**
     * Set valor
     *
     * @param string $valor
     *
     * @return FtProyectoRegistroCliente
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
     * Set moneda
     *
     * @param integer $moneda
     *
     * @return FtProyectoRegistroCliente
     */
    public function setMoneda($moneda)
    {
        $this->moneda = $moneda;

        return $this;
    }

    /**
     * Get moneda
     *
     * @return integer
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * Set empresaAsociada
     *
     * @param string $empresaAsociada
     *
     * @return FtProyectoRegistroCliente
     */
    public function setEmpresaAsociada($empresaAsociada)
    {
        $this->empresaAsociada = $empresaAsociada;

        return $this;
    }

    /**
     * Get empresaAsociada
     *
     * @return string
     */
    public function getEmpresaAsociada()
    {
        return $this->empresaAsociada;
    }

    /**
     * Set nombreProyecto
     *
     * @param string $nombreProyecto
     *
     * @return FtProyectoRegistroCliente
     */
    public function setNombreProyecto($nombreProyecto)
    {
        $this->nombreProyecto = $nombreProyecto;

        return $this;
    }

    /**
     * Get nombreProyecto
     *
     * @return string
     */
    public function getNombreProyecto()
    {
        return $this->nombreProyecto;
    }

    /**
     * Set duracion
     *
     * @param string $duracion
     *
     * @return FtProyectoRegistroCliente
     */
    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;

        return $this;
    }

    /**
     * Get duracion
     *
     * @return string
     */
    public function getDuracion()
    {
        return $this->duracion;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtProyectoRegistroCliente
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtProyectoRegistroCliente
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
     * Set ftRegistroCliente
     *
     * @param integer $ftRegistroCliente
     *
     * @return FtProyectoRegistroCliente
     */
    public function setFtRegistroCliente($ftRegistroCliente)
    {
        $this->ftRegistroCliente = $ftRegistroCliente;

        return $this;
    }

    /**
     * Get ftRegistroCliente
     *
     * @return integer
     */
    public function getFtRegistroCliente()
    {
        return $this->ftRegistroCliente;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtProyectoRegistroCliente
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtProyectoRegistroCliente
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtProyectoRegistroCliente
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtProyectoRegistroCliente
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

