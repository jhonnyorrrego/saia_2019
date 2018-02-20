<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Factura
 *
 * @ORM\Table(name="factura")
 * @ORM\Entity
 */
class Factura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfactura", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="FACTURA_IDFACTURA_seq", allocationSize=1, initialValue=1)
     */
    private $idfactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado_factura_idencabezad", type="integer", nullable=true)
     */
    private $encabezadoFacturaIdencabezad;

    /**
     * @var string
     *
     * @ORM\Column(name="cuenta", type="string", length=30, nullable=true)
     */
    private $cuenta;

    /**
     * @var integer
     *
     * @ORM\Column(name="credito", type="integer", nullable=true)
     */
    private $credito;

    /**
     * @var string
     *
     * @ORM\Column(name="centro_costos", type="string", length=30, nullable=true)
     */
    private $centroCostos;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=30, nullable=true)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="naturaleza", type="string", length=7, nullable=false)
     */
    private $naturaleza;


}

