<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDetalleGastoLegalizacion
 *
 * @ORM\Table(name="ft_detalle_gasto_legalizacion")
 * @ORM\Entity
 */
class FtDetalleGastoLegalizacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_detalle_gasto_legalizacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftDetalleGastoLegalizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_detalle", type="text", length=65535, nullable=false)
     */
    private $descripcionDetalle;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_detalle", type="date", nullable=false)
     */
    private $fechaDetalle;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_legalizacion_gastos_viaje", type="integer", nullable=false)
     */
    private $ftLegalizacionGastosViaje;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1399';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_gasto", type="string", length=255, nullable=false)
     */
    private $tipoGasto;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=false)
     */
    private $valor;


}

