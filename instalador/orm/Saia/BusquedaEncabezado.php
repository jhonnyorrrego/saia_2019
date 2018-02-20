<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaEncabezado
 *
 * @ORM\Table(name="busqueda_encabezado")
 * @ORM\Entity
 */
class BusquedaEncabezado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_encabezado", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaEncabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="encabezado", type="text", nullable=true)
     */
    private $encabezado;

    /**
     * @var string
     *
     * @ORM\Column(name="pie", type="text", nullable=true)
     */
    private $pie;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idbusqueda_componente", type="integer", nullable=false)
     */
    private $fkIdbusquedaComponente;



    /**
     * Get idbusquedaEncabezado
     *
     * @return integer
     */
    public function getIdbusquedaEncabezado()
    {
        return $this->idbusquedaEncabezado;
    }

    /**
     * Set encabezado
     *
     * @param string $encabezado
     *
     * @return BusquedaEncabezado
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return string
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set pie
     *
     * @param string $pie
     *
     * @return BusquedaEncabezado
     */
    public function setPie($pie)
    {
        $this->pie = $pie;

        return $this;
    }

    /**
     * Get pie
     *
     * @return string
     */
    public function getPie()
    {
        return $this->pie;
    }

    /**
     * Set fkIdbusquedaComponente
     *
     * @param integer $fkIdbusquedaComponente
     *
     * @return BusquedaEncabezado
     */
    public function setFkIdbusquedaComponente($fkIdbusquedaComponente)
    {
        $this->fkIdbusquedaComponente = $fkIdbusquedaComponente;

        return $this;
    }

    /**
     * Get fkIdbusquedaComponente
     *
     * @return integer
     */
    public function getFkIdbusquedaComponente()
    {
        return $this->fkIdbusquedaComponente;
    }
}
