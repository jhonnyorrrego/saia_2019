<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemRecibidos
 *
 * @ORM\Table(name="ft_item_recibidos")
 * @ORM\Entity
 */
class FtItemRecibidos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_recibidos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemRecibidos;

    /**
     * @var string
     *
     * @ORM\Column(name="creador_recibida", type="string", length=255, nullable=false)
     */
    private $creadorRecibida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_recibida", type="datetime", nullable=false)
     */
    private $fechaRecibida;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_radicacion_facturas", type="integer", nullable=false)
     */
    private $ftRadicacionFacturas;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_reci", type="text", length=65535, nullable=true)
     */
    private $observacionesReci;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_recibido", type="string", length=255, nullable=false)
     */
    private $tipoRecibido;


}

