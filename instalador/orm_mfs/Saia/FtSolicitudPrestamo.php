<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudPrestamo
 *
 * @ORM\Table(name="ft_solicitud_prestamo")
 * @ORM\Entity
 */
class FtSolicitudPrestamo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_prestamo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudPrestamo;

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
    private $serieIdserie = '1319';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_archivo", type="integer", nullable=false)
     */
    private $documentoArchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=false)
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_prestamo_rep", type="date", nullable=true)
     */
    private $fechaPrestamoRep;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_devolucion_rep", type="date", nullable=true)
     */
    private $fechaDevolucionRep;

    /**
     * @var string
     *
     * @ORM\Column(name="transferencia_presta", type="string", length=255, nullable=false)
     */
    private $transferenciaPresta;


}

