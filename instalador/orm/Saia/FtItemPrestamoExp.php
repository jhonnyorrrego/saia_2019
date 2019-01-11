<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemPrestamoExp
 *
 * @ORM\Table(name="ft_item_prestamo_exp")
 * @ORM\Entity
 */
class FtItemPrestamoExp
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_prestamo_exp", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemPrestamoExp;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_prestamo", type="integer", nullable=true)
     */
    private $estadoPrestamo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_devolucion", type="datetime", nullable=true)
     */
    private $fechaDevolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_prestamo", type="datetime", nullable=true)
     */
    private $fechaPrestamo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_expediente", type="integer", nullable=false)
     */
    private $fkExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_prestamo", type="integer", nullable=false)
     */
    private $ftSolicitudPrestamo;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_devoluci", type="integer", nullable=true)
     */
    private $funcionarioDevoluci;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_prestamo", type="integer", nullable=true)
     */
    private $funcionarioPrestamo;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_devolver", type="string", length=255, nullable=true)
     */
    private $observacionDevolver;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_prestamo", type="string", length=255, nullable=true)
     */
    private $observacionPrestamo;


}

