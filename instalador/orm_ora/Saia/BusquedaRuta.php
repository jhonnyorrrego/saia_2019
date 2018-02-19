<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaRuta
 *
 * @ORM\Table(name="BUSQUEDA_RUTA")
 * @ORM\Entity
 */
class BusquedaRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDBUSQUEDA_RUTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_RUTA_IDBUSQUEDA_RUTA_", allocationSize=1, initialValue=1)
     */
    private $idbusquedaRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA_ORIGEN", type="string", length=255, nullable=true)
     */
    private $tablaOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="TABLA_DESTINO", type="string", length=255, nullable=true)
     */
    private $tablaDestino;


}

