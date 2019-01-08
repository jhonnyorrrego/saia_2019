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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

