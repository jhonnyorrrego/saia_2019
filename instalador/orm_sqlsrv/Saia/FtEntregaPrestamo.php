<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEntregaPrestamo
 *
 * @ORM\Table(name="ft_entrega_prestamo", indexes={@ORM\Index(name="i_ft_entrega_prestamo_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtEntregaPrestamo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_entrega_prestamo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftEntregaPrestamo;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1320';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_prestamo", type="integer", nullable=false)
     */
    private $ftSolicitudPrestamo;

    /**
     * @var string
     *
     * @ORM\Column(name="usuario_devolucion", type="string", length=255, nullable=true)
     */
    private $usuarioDevolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_devolu", type="string", length=255, nullable=true)
     */
    private $observacionesDevolu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_devolucion", type="datetime", nullable=true)
     */
    private $fechaDevolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_devolucion", type="integer", nullable=false)
     */
    private $estadoDevolucion;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_entrega", type="datetime", nullable=false)
     */
    private $fechaEntrega;

    /**
     * @var string
     *
     * @ORM\Column(name="transferencia_presta", type="string", length=255, nullable=false)
     */
    private $transferenciaPresta;


}
