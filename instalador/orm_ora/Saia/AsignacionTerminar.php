<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsignacionTerminar
 *
 * @ORM\Table(name="ASIGNACION_TERMINAR")
 * @ORM\Entity
 */
class AsignacionTerminar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDASIGNACION_TERMINAR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ASIGNACION_TERMINAR_IDASIGNACI", allocationSize=1, initialValue=1)
     */
    private $idasignacionTerminar;

    /**
     * @var integer
     *
     * @ORM\Column(name="ASIGNACION_IDASIGNACION", type="integer", nullable=true)
     */
    private $asignacionIdasignacion;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSTIFICACION", type="string", length=2000, nullable=true)
     */
    private $justificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_TERMINACION", type="date", nullable=true)
     */
    private $fechaTerminacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=true)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TAREA_IDTAREA", type="integer", nullable=true)
     */
    private $tareaIdtarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=true)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=true)
     */
    private $fechaFinal;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=true)
     */
    private $estado = 'PENDIENTE';

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=true)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="integer", nullable=true)
     */
    private $llaveEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="REPROGRAMA", type="integer", nullable=true)
     */
    private $reprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_REPROGRAMA", type="string", length=10, nullable=true)
     */
    private $tipoReprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;


}

