<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemAprobaciones
 *
 * @ORM\Table(name="ft_item_aprobaciones")
 * @ORM\Entity
 */
class FtItemAprobaciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_aprobaciones", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemAprobaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=255, nullable=true)
     */
    private $accion;

    /**
     * @var string
     *
     * @ORM\Column(name="arbol_devuelto", type="string", length=255, nullable=false)
     */
    private $arbolDevuelto;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=true)
     */
    private $dependencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobacion", type="datetime", nullable=true)
     */
    private $fechaAprobacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_radicacion_facturas", type="integer", nullable=false)
     */
    private $ftRadicacionFacturas;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="transferido_a", type="string", length=255, nullable=true)
     */
    private $transferidoA;


}

