<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaIndicador
 *
 * @ORM\Table(name="busqueda_indicador")
 * @ORM\Entity
 */
class BusquedaIndicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_indicador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaIndicador;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_idbusqueda_componente", type="integer", nullable=false)
     */
    private $busquedaIdbusquedaComponente;

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
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ancho", type="integer", nullable=false)
     */
    private $ancho;

    /**
     * @var integer
     *
     * @ORM\Column(name="alto", type="integer", nullable=false)
     */
    private $alto;



    /**
     * Get idbusquedaIndicador
     *
     * @return integer
     */
    public function getIdbusquedaIndicador()
    {
        return $this->idbusquedaIndicador;
    }

    /**
     * Set busquedaIdbusquedaComponente
     *
     * @param integer $busquedaIdbusquedaComponente
     *
     * @return BusquedaIndicador
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
     * Set indicadorIdindicador
     *
     * @param integer $indicadorIdindicador
     *
     * @return BusquedaIndicador
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
     * @return BusquedaIndicador
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return BusquedaIndicador
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
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return BusquedaIndicador
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
     * Set ancho
     *
     * @param integer $ancho
     *
     * @return BusquedaIndicador
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
     * @return BusquedaIndicador
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
}
