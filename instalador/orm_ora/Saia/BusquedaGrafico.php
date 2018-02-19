<?php

namespace Saia;

/**
 * BusquedaGrafico
 */
class BusquedaGrafico
{
    /**
     * @var integer
     */
    private $idbusquedaGrafico;

    /**
     * @var integer
     */
    private $busquedaIdbusquedaComponente;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var string
     */
    private $etiquetax;

    /**
     * @var string
     */
    private $etiquetay;

    /**
     * @var integer
     */
    private $tipoGrafico;

    /**
     * @var integer
     */
    private $ancho;

    /**
     * @var integer
     */
    private $alto;

    /**
     * @var integer
     */
    private $direccionTitulo;

    /**
     * @var integer
     */
    private $estado;

    /**
     * @var integer
     */
    private $orden;

    /**
     * @var integer
     */
    private $indicadorIdindicador;

    /**
     * @var string
     */
    private $nombre;


    /**
     * Get idbusquedaGrafico
     *
     * @return integer
     */
    public function getIdbusquedaGrafico()
    {
        return $this->idbusquedaGrafico;
    }

    /**
     * Set busquedaIdbusquedaComponente
     *
     * @param integer $busquedaIdbusquedaComponente
     *
     * @return BusquedaGrafico
     */
    public function setBusquedaIdbusquedaComponente($busquedaIdbusquedaComponente)
    {
        $this->busquedaIdbusquedaComponente = $busquedaIdbusquedaComponente;

        return $this;
    }

    /**
     * Get busquedaIdbusquedaComponente
     *
     * @return integer
     */
    public function getBusquedaIdbusquedaComponente()
    {
        return $this->busquedaIdbusquedaComponente;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return BusquedaGrafico
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set etiquetax
     *
     * @param string $etiquetax
     *
     * @return BusquedaGrafico
     */
    public function setEtiquetax($etiquetax)
    {
        $this->etiquetax = $etiquetax;

        return $this;
    }

    /**
     * Get etiquetax
     *
     * @return string
     */
    public function getEtiquetax()
    {
        return $this->etiquetax;
    }

    /**
     * Set etiquetay
     *
     * @param string $etiquetay
     *
     * @return BusquedaGrafico
     */
    public function setEtiquetay($etiquetay)
    {
        $this->etiquetay = $etiquetay;

        return $this;
    }

    /**
     * Get etiquetay
     *
     * @return string
     */
    public function getEtiquetay()
    {
        return $this->etiquetay;
    }

    /**
     * Set tipoGrafico
     *
     * @param integer $tipoGrafico
     *
     * @return BusquedaGrafico
     */
    public function setTipoGrafico($tipoGrafico)
    {
        $this->tipoGrafico = $tipoGrafico;

        return $this;
    }

    /**
     * Get tipoGrafico
     *
     * @return integer
     */
    public function getTipoGrafico()
    {
        return $this->tipoGrafico;
    }

    /**
     * Set ancho
     *
     * @param integer $ancho
     *
     * @return BusquedaGrafico
     */
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;

        return $this;
    }

    /**
     * Get ancho
     *
     * @return integer
     */
    public function getAncho()
    {
        return $this->ancho;
    }

    /**
     * Set alto
     *
     * @param integer $alto
     *
     * @return BusquedaGrafico
     */
    public function setAlto($alto)
    {
        $this->alto = $alto;

        return $this;
    }

    /**
     * Get alto
     *
     * @return integer
     */
    public function getAlto()
    {
        return $this->alto;
    }

    /**
     * Set direccionTitulo
     *
     * @param integer $direccionTitulo
     *
     * @return BusquedaGrafico
     */
    public function setDireccionTitulo($direccionTitulo)
    {
        $this->direccionTitulo = $direccionTitulo;

        return $this;
    }

    /**
     * Get direccionTitulo
     *
     * @return integer
     */
    public function getDireccionTitulo()
    {
        return $this->direccionTitulo;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return BusquedaGrafico
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return BusquedaGrafico
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set indicadorIdindicador
     *
     * @param integer $indicadorIdindicador
     *
     * @return BusquedaGrafico
     */
    public function setIndicadorIdindicador($indicadorIdindicador)
    {
        $this->indicadorIdindicador = $indicadorIdindicador;

        return $this;
    }

    /**
     * Get indicadorIdindicador
     *
     * @return integer
     */
    public function getIndicadorIdindicador()
    {
        return $this->indicadorIdindicador;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return BusquedaGrafico
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
}

