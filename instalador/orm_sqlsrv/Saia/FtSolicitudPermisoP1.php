<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudPermisoP1
 *
 * @ORM\Table(name="ft_solicitud_permiso_p1")
 * @ORM\Entity
 */
class FtSolicitudPermisoP1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_permiso_p1", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudPermisoP1;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

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
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="datetime", nullable=false)
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
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1453';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_permiso", type="integer", nullable=false)
     */
    private $tipoPermiso;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_permiso", type="datetime", nullable=false)
     */
    private $fechaPermiso;

    /**
     * @var integer
     *
     * @ORM\Column(name="salida_porteria", type="integer", nullable=false)
     */
    private $salidaPorteria = '4';

    /**
     * @var integer
     *
     * @ORM\Column(name="compensacion", type="integer", nullable=false)
     */
    private $compensacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="clase_permiso", type="integer", nullable=false)
     */
    private $clasePermiso;


}

