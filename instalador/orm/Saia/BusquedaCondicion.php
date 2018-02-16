<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaCondicion
 *
 * @ORM\Table(name="busqueda_condicion")
 * @ORM\Entity
 */
class BusquedaCondicion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_condicion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idbusquedaCondicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="busqueda_idbusqueda", type="integer", nullable=true)
     */
    private $busquedaIdbusqueda;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_busqueda_componente", type="integer", nullable=true)
     */
    private $fkBusquedaComponente;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_where", type="text", length=65535, nullable=true)
     */
    private $codigoWhere;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta_condicion", type="string", length=255, nullable=true)
     */
    private $etiquetaCondicion;



    /**
     * Get idbusquedaCondicion
     *
     * @return integer
     */
    public function getIdbusquedaCondicion()
    {
        return $this->idbusquedaCondicion;
    }

    /**
     * Set busquedaIdbusqueda
     *
     * @param integer $busquedaIdbusqueda
     *
     * @return BusquedaCondicion
     */
    public function setBusquedaIdbusqueda($busquedaIdbusqueda)
    {
        $this->busquedaIdbusqueda = $busquedaIdbusqueda;

        return $this;
    }

    /**
     * Get busquedaIdbusqueda
     *
     * @return integer
     */
    public function getBusquedaIdbusqueda()
    {
        return $this->busquedaIdbusqueda;
    }

    /**
     * Set fkBusquedaComponente
     *
     * @param integer $fkBusquedaComponente
     *
     * @return BusquedaCondicion
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
     * Set codigoWhere
     *
     * @param string $codigoWhere
     *
     * @return BusquedaCondicion
     */
    public function setCodigoWhere($codigoWhere)
    {
        $this->codigoWhere = $codigoWhere;

        return $this;
    }

    /**
     * Get codigoWhere
     *
     * @return string
     */
    public function getCodigoWhere()
    {
        return $this->codigoWhere;
    }

    /**
     * Set etiquetaCondicion
     *
     * @param string $etiquetaCondicion
     *
     * @return BusquedaCondicion
     */
    public function setEtiquetaCondicion($etiquetaCondicion)
    {
        $this->etiquetaCondicion = $etiquetaCondicion;

        return $this;
    }

    /**
     * Get etiquetaCondicion
     *
     * @return string
     */
    public function getEtiquetaCondicion()
    {
        return $this->etiquetaCondicion;
    }
}
