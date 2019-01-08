<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudPersonal
 *
 * @ORM\Table(name="ft_solicitud_personal")
 * @ORM\Entity
 */
class FtSolicitudPersonal
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_personal", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudPersonal;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_usuario", type="string", length=255, nullable=false)
     */
    private $cargoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencia_usuario", type="string", length=255, nullable=false)
     */
    private $dependenciaUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="educacion", type="text", length=65535, nullable=false)
     */
    private $educacion;

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
     * @var string
     *
     * @ORM\Column(name="experiencia", type="text", length=65535, nullable=false)
     */
    private $experiencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vinculacion", type="date", nullable=false)
     */
    private $fechaVinculacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="formacion", type="text", length=65535, nullable=false)
     */
    private $formacion;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion_solicitud", type="text", length=65535, nullable=false)
     */
    private $justificacionSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="salario", type="integer", nullable=false)
     */
    private $salario;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1368';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_contrato", type="integer", nullable=false)
     */
    private $tipoContrato;


}

