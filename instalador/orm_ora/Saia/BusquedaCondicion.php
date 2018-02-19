<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaCondicion
 *
 * @ORM\Table(name="BUSQUEDA_CONDICION")
 * @ORM\Entity
 */
class BusquedaCondicion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_CONDICION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_CONDICION_IDBUSQUEDA_", allocationSize=1, initialValue=1)
     */
    private $idbusquedaCondicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="BUSQUEDA_IDBUSQUEDA", type="integer", nullable=true)
     */
    private $busquedaIdbusqueda;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_BUSQUEDA_COMPONENTE", type="integer", nullable=true)
     */
    private $fkBusquedaComponente;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_WHERE", type="text", nullable=true)
     */
    private $codigoWhere;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA_CONDICION", type="string", length=255, nullable=true)
     */
    private $etiquetaCondicion;


}
