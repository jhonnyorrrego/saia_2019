<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudPermisos
 *
 * @ORM\Table(name="ft_solicitud_permisos")
 * @ORM\Entity
 */
class FtSolicitudPermisos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_permisos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitudPermisos;

    /**
     * @var integer
     *
     * @ORM\Column(name="accion_compen", type="integer", nullable=true)
     */
    private $accionCompen;

    /**
     * @var string
     *
     * @ORM\Column(name="acuerdo", type="text", length=65535, nullable=true)
     */
    private $acuerdo;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo", type="string", length=255, nullable=false)
     */
    private $cargo;

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
     * @ORM\Column(name="fecha_compensacion", type="date", nullable=true)
     */
    private $fechaCompensacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_llegada", type="datetime", nullable=false)
     */
    private $fechaHoraLlegada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_salida", type="datetime", nullable=false)
     */
    private $fechaHoraSalida;

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
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario_permiso", type="string", length=255, nullable=true)
     */
    private $funcionarioPermiso;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="obs_compensa", type="text", length=65535, nullable=true)
     */
    private $obsCompensa;

    /**
     * @var string
     *
     * @ORM\Column(name="persona_autoriza", type="string", length=255, nullable=false)
     */
    private $personaAutoriza;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1228';

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_compensado", type="integer", nullable=false)
     */
    private $tiempoCompensado = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo_real", type="string", length=255, nullable=true)
     */
    private $tiempoReal;

    /**
     * @var string
     *
     * @ORM\Column(name="tiempo_requerido", type="string", length=255, nullable=false)
     */
    private $tiempoRequerido;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_permiso", type="integer", nullable=false)
     */
    private $tipoPermiso;


}

