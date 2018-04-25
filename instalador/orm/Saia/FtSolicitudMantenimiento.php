<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudMantenimiento
 *
 * @ORM\Table(name="ft_solicitud_mantenimiento")
 * @ORM\Entity
 */
class FtSolicitudMantenimiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_mantenimiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudMantenimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="activo", type="string", length=255, nullable=false)
     */
    private $activo;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_solicitud", type="text", length=65535, nullable=false)
     */
    private $descripcionSolicitud;

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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_registro_activos_fijos", type="integer", nullable=false)
     */
    private $ftRegistroActivosFijos;

    /**
     * @var string
     *
     * @ORM\Column(name="id_padre", type="string", length=255, nullable=true)
     */
    private $idPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="prioridad", type="integer", nullable=false)
     */
    private $prioridad = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '908';

    /**
     * @var string
     *
     * @ORM\Column(name="obs_solic_mant", type="text", length=65535, nullable=true)
     */
    private $obsSolicMant;


}

