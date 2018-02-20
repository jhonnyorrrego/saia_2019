<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsignacionTerminar
 *
 * @ORM\Table(name="ASIGNACION_TERMINAR", indexes={@ORM\Index(name="i_asignacion_terminar_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
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
     * @ORM\Column(name="ASIGNACION_IDASIGNACION", type="integer", nullable=false)
     */
    private $asignacionIdasignacion;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSTIFICACION", type="string", length=512, nullable=false)
     */
    private $justificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_TERMINACION", type="date", nullable=false)
     */
    private $fechaTerminacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_CODIGO", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TAREA_IDTAREA", type="integer", nullable=false)
     */
    private $tareaIdtarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=false)
     */
    private $fechaFinal;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=4000, nullable=false)
     */
    private $estado = 'PENDIENTE';

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="integer", nullable=false)
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

