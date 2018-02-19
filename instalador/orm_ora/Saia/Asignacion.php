<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asignacion
 *
 * @ORM\Table(name="ASIGNACION", indexes={@ORM\Index(name="asignacion_llave_entidad", columns={"LLAVE_ENTIDAD"}), @ORM\Index(name="asignacion_serie", columns={"SERIE_IDSERIE"}), @ORM\Index(name="asignacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class Asignacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDASIGNACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ASIGNACION_IDASIGNACION_seq", allocationSize=1, initialValue=1)
     */
    private $idasignacion;

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
    private $fechaInicial = 'sysdate';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=true)
     */
    private $fechaFinal = 'sysdate';

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
     * @ORM\Column(name="ESTADO", type="string", length=4000, nullable=true)
     */
    private $estado = 'PENDIENTE';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="integer", nullable=true)
     */
    private $llaveEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="REPROGRAMA", type="string", length=4, nullable=true)
     */
    private $reprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_REPROGRAMA", type="string", length=255, nullable=true)
     */
    private $tipoReprograma;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=true)
     */
    private $entidadIdentidad;


}
