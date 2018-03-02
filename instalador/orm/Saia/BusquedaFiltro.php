<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaFiltro
 *
 * @ORM\Table(name="busqueda_filtro")
 * @ORM\Entity
 */
class BusquedaFiltro
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_filtro", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaFiltro;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_busqueda_componente", type="integer", nullable=false)
     */
    private $fkBusquedaComponente;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_adicional", type="string", length=255, nullable=false)
     */
    private $tablaAdicional;

    /**
     * @var string
     *
     * @ORM\Column(name="where_adicional", type="string", length=255, nullable=false)
     */
    private $whereAdicional;



    /**
     * Get idbusquedaFiltro
     *
     * @return integer
     */
    public function getIdbusquedaFiltro()
    {
        return $this->idbusquedaFiltro;
    }

    /**
     * Set fkBusquedaComponente
     *
     * @param integer $fkBusquedaComponente
     *
     * @return BusquedaFiltro
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
     * @return BusquedaFiltro
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
     * Set tablaAdicional
     *
     * @param string $tablaAdicional
     *
     * @return BusquedaFiltro
     */
    public function setTablaAdicional($tablaAdicional)
    {
        $this->tablaAdicional = $tablaAdicional;

        return $this;
    }

    /**
     * Get tablaAdicional
     *
     * @return string
     */
    public function getTablaAdicional()
    {
        return $this->tablaAdicional;
    }

    /**
     * Set whereAdicional
     *
     * @param string $whereAdicional
     *
     * @return BusquedaFiltro
     */
    public function setWhereAdicional($whereAdicional)
    {
        $this->whereAdicional = $whereAdicional;

        return $this;
    }

    /**
     * Get whereAdicional
     *
     * @return string
     */
    public function getWhereAdicional()
    {
        return $this->whereAdicional;
    }
}
