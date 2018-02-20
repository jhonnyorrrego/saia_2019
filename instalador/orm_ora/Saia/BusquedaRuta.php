<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BusquedaRuta
 *
 * @ORM\Table(name="busqueda_ruta")
 * @ORM\Entity
 */
class BusquedaRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idbusqueda_ruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="BUSQUEDA_RUTA_IDBUSQUEDA_RUTA_", allocationSize=1, initialValue=1)
     */
    private $idbusquedaRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_origen", type="string", length=255, nullable=false)
     */
    private $tablaOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="tabla_destino", type="string", length=255, nullable=false)
     */
    private $tablaDestino;


}

