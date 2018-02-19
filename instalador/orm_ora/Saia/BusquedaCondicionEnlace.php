<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaCondicionEnlace
 *
 * @ORM\Table(name="BUSQUEDA_CONDICION_ENLACE")
 * @ORM\Entity
 */
class BusquedaCondicionEnlace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_CONDICION_ENLACE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_CONDICION_ENLACE_IDBU", allocationSize=1, initialValue=1)
     */
    private $idbusquedaCondicionEnlace;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_BUSQUEDA_CONDICION", type="integer", nullable=true)
     */
    private $fkBusquedaCondicion;

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="COMPARACION", type="string", length=10, nullable=true)
     */
    private $comparacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var boolean
     *
     * @ORM\Column(name="ESTADO", type="boolean", nullable=true)
     */
    private $estado = '1';


}

