<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Factura
 *
 * @ORM\Table(name="FACTURA")
 * @ORM\Entity
 */
class Factura
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFACTURA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FACTURA_IDFACTURA_seq", allocationSize=1, initialValue=1)
     */
    private $idfactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO_FACTURA_IDENCABEZAD", type="integer", nullable=true)
     */
    private $encabezadoFacturaIdencabezad;

    /**
     * @var string
     *
     * @ORM\Column(name="CUENTA", type="string", length=30, nullable=true)
     */
    private $cuenta;

    /**
     * @var integer
     *
     * @ORM\Column(name="CREDITO", type="integer", nullable=true)
     */
    private $credito;

    /**
     * @var string
     *
     * @ORM\Column(name="CENTRO_COSTOS", type="string", length=30, nullable=true)
     */
    private $centroCostos;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCION", type="string", length=30, nullable=true)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="NATURALEZA", type="string", length=7, nullable=false)
     */
    private $naturaleza;


}

