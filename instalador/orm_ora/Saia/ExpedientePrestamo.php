<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ExpedientePrestamo
 *
 * @ORM\Table(name="EXPEDIENTE_PRESTAMO")
 * @ORM\Entity
 */
class ExpedientePrestamo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDEXPEDIENTE_PRESTAMO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="EXPEDIENTE_PRESTAMO_IDEXPEDIEN", allocationSize=1, initialValue=1)
     */
    private $idexpedientePrestamo;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXPEDIENTE_IDEXPEDIENTE", type="integer", nullable=true)
     */
    private $expedienteIdexpediente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRESTAMO", type="integer", nullable=false)
     */
    private $prestamo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_DEVOLUCION", type="date", nullable=true)
     */
    private $fechaDevolucion;


}

