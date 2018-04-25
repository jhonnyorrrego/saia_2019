<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCuotasExtraor
 *
 * @ORM\Table(name="ft_cuotas_extraor")
 * @ORM\Entity
 */
class FtCuotasExtraor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_cuotas_extraor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCuotasExtraor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pago", type="date", nullable=false)
     */
    private $fechaPago;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_prestamos", type="integer", nullable=false)
     */
    private $ftSolicitudPrestamos;

    /**
     * @var string
     *
     * @ORM\Column(name="pantalla", type="string", length=255, nullable=true)
     */
    private $pantalla;

    /**
     * @var string
     *
     * @ORM\Column(name="prima_semestral", type="string", length=255, nullable=false)
     */
    private $primaSemestral;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_cuota_extra", type="string", length=255, nullable=false)
     */
    private $valorCuotaExtra;


}

