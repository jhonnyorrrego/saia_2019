<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNovedadPrestamo
 *
 * @ORM\Table(name="ft_novedad_prestamo")
 * @ORM\Entity
 */
class FtNovedadPrestamo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_novedad_prestamo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftNovedadPrestamo;

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
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicitud_prestamos", type="integer", nullable=false)
     */
    private $ftSolicitudPrestamos;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_nove", type="text", length=65535, nullable=true)
     */
    private $observacionNove;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1088';

    /**
     * @var string
     *
     * @ORM\Column(name="soporte_novedad", type="string", length=255, nullable=false)
     */
    private $soporteNovedad;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_novedad", type="integer", nullable=false)
     */
    private $tipoNovedad;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_cuota_extr", type="string", length=255, nullable=true)
     */
    private $valorCuotaExtr;


}

