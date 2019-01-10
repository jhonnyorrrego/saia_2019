<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaBusqueda
 *
 * @ORM\Table(name="pantalla_busqueda")
 * @ORM\Entity
 */
class PantallaBusqueda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_busqueda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaBusqueda;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';


}

