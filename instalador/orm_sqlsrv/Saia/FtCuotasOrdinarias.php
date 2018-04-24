<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCuotasOrdinarias
 *
 * @ORM\Table(name="ft_cuotas_ordinarias")
 * @ORM\Entity
 */
class FtCuotasOrdinarias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_cuotas_ordinarias", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftCuotasOrdinarias;

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
     * @var integer
     *
     * @ORM\Column(name="numero_cuotas", type="integer", nullable=false)
     */
    private $numeroCuotas;

    /**
     * @var string
     *
     * @ORM\Column(name="pantalla", type="string", length=255, nullable=true)
     */
    private $pantalla;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_cuo_ordina", type="string", length=255, nullable=false)
     */
    private $valorCuoOrdina;


}

