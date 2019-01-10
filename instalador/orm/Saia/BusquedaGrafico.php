<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaGrafico
 *
 * @ORM\Table(name="busqueda_grafico")
 * @ORM\Entity
 */
class BusquedaGrafico
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_grafico", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idbusquedaGrafico;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_idbusqueda_componente", type="integer", nullable=false)
     */
    private $busquedaIdbusquedaComponente;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="etiquetax", type="string", length=255, nullable=false)
     */
    private $etiquetax;

    /**
     * @var string
     *
     * @ORM\Column(name="etiquetay", type="string", length=255, nullable=false)
     */
    private $etiquetay;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_grafico", type="integer", nullable=false)
     */
    private $tipoGrafico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ancho", type="integer", nullable=false)
     */
    private $ancho = '300';

    /**
     * @var integer
     *
     * @ORM\Column(name="alto", type="integer", nullable=false)
     */
    private $alto = '400';

    /**
     * @var integer
     *
     * @ORM\Column(name="direccion_titulo", type="integer", nullable=false)
     */
    private $direccionTitulo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="indicador_idindicador", type="integer", nullable=false)
     */
    private $indicadorIdindicador;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
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
