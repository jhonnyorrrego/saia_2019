<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaFiltroTemp
 *
 * @ORM\Table(name="busqueda_filtro_temp")
 * @ORM\Entity
 */
class BusquedaFiltroTemp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_filtro_temp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaFiltroTemp;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_busqueda_componente", type="integer", nullable=true)
     */
    private $fkBusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="detalle", type="text", length=65535, nullable=true)
     */
    private $detalle;



    /**
     * Get idbusquedaFiltroTemp
     *
     * @return integer
     */
    public function getIdbusquedaFiltroTemp()
    {
        return $this->idbusquedaFiltroTemp;
    }

    /**
     * Set fkBusquedaComponente
     *
     * @param integer $fkBusquedaComponente
     *
     * @return BusquedaFiltroTemp
     */
    public function setFkBusquedaComponente($fkBusquedaComponente)
    {
        $this->fkBusquedaComponente = $fkBusquedaComponente;

        return $this;
    }

    /**
     * Get fkBusquedaComponente
     *
     * @return integer
     */
    public function getFkBusquedaComponente()
    {
        return $this->fkBusquedaComponente;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return BusquedaFiltroTemp
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return BusquedaFiltroTemp
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
     * Set detalle
     *
     * @param string $detalle
     *
     * @return BusquedaFiltroTemp
     */
    public function setDetalle($detalle)
    {
        $this->detalle = $detalle;

        return $this;
    }

    /**
     * Get detalle
     *
     * @return string
     */
    public function getDetalle()
    {
        return $this->detalle;
    }
}
