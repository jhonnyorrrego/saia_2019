<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaCondicionEnlace
 *
 * @ORM\Table(name="busqueda_condicion_enlace")
 * @ORM\Entity
 */
class BusquedaCondicionEnlace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_condicion_enlace", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaCondicionEnlace;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_busqueda_condicion", type="integer", nullable=true)
     */
    private $fkBusquedaCondicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="comparacion", type="string", length=10, nullable=true)
     */
    private $comparacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = '1';



    /**
     * Get idbusquedaCondicionEnlace
     *
     * @return integer
     */
    public function getIdbusquedaCondicionEnlace()
    {
        return $this->idbusquedaCondicionEnlace;
    }

    /**
     * Set fkBusquedaCondicion
     *
     * @param integer $fkBusquedaCondicion
     *
     * @return BusquedaCondicionEnlace
     */
    public function setFkBusquedaCondicion($fkBusquedaCondicion)
    {
        $this->fkBusquedaCondicion = $fkBusquedaCondicion;

        return $this;
    }

    /**
     * Get fkBusquedaCondicion
     *
     * @return integer
     */
    public function getFkBusquedaCondicion()
    {
        return $this->fkBusquedaCondicion;
    }

    /**
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return BusquedaCondicionEnlace
     */
    public function setCodPadre($codPadre)
    {
        $this->codPadre = $codPadre;

        return $this;
    }

    /**
     * Get codPadre
     *
     * @return integer
     */
    public function getCodPadre()
    {
        return $this->codPadre;
    }

    /**
     * Set comparacion
     *
     * @param string $comparacion
     *
     * @return BusquedaCondicionEnlace
     */
    public function setComparacion($comparacion)
    {
        $this->comparacion = $comparacion;

        return $this;
    }

    /**
     * Get comparacion
     *
     * @return string
     */
    public function getComparacion()
    {
        return $this->comparacion;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return BusquedaCondicionEnlace
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
     * Set estado
     *
     * @param integer $estado
     *
     * @return BusquedaCondicionEnlace
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
}
