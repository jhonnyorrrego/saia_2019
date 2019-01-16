<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsignacionTerminar
 *
 * @ORM\Table(name="asignacion_terminar", indexes={@ORM\Index(name="i_asignacion_terminar_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class AsignacionTerminar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idasignacion_terminar", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ASIGNACION_TERMINAR_IDASIGNACI", allocationSize=1, initialValue=1)
     */
    private $idasignacionTerminar;

    /**
     * @var integer
     *
     * @ORM\Column(name="asignacion_idasignacion", type="integer", nullable=false)
     */
    private $asignacionIdasignacion;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="string", length=512, nullable=false)
     */
    private $justificacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_terminacion", type="date", nullable=false)
     */
    private $fechaTerminacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_codigo", type="integer", nullable=false)
     */
    private $funcionarioCodigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tarea_idtarea", type="integer", nullable=false)
     */
    private $tareaIdtarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal;

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
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=4000, nullable=false)
     */
    private $estado = 'PENDIENTE';

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad", type="integer", nullable=false)
     */
    private $llaveEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="reprograma", type="integer", nullable=true)
     */
    private $reprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_reprograma", type="string", length=10, nullable=true)
     */
    private $tipoReprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;


}

