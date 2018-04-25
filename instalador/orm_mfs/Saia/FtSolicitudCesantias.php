<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudCesantias
 *
 * @ORM\Table(name="ft_solicitud_cesantias")
 * @ORM\Entity
 */
class FtSolicitudCesantias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_cesantias", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudCesantias;

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
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="motivo_cesantias", type="integer", nullable=false)
     */
    private $motivoCesantias;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_cesantias", type="text", length=65535, nullable=false)
     */
    private $observacionCesantias;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1229';

    /**
     * @var string
     *
     * @ORM\Column(name="soporte_solicitud", type="string", length=255, nullable=false)
     */
    private $soporteSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_solicitado", type="string", length=255, nullable=false)
     */
    private $valorSolicitado;


}

