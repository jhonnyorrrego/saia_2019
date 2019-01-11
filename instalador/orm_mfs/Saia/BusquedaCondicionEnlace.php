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
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

