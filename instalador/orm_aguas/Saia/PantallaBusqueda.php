<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaBusqueda
 *
 * @ORM\Table(name="PANTALLA_BUSQUEDA")
 * @ORM\Entity
 */
class PantallaBusqueda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPANTALLA_BUSQUEDA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PANTALLA_BUSQUEDA_IDPANTALLA_B", allocationSize=1, initialValue=1)
     */
    private $idpantallaBusqueda;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA", type="string", length=255, nullable=false)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';


}
