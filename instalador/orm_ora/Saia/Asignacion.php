<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asignacion
 *
 * @ORM\Table(name="asignacion", indexes={@ORM\Index(name="i_asignacion_llave_entida", columns={"llave_entidad"}), @ORM\Index(name="i_asignacion_fecha_inicia", columns={"fecha_inicial"}), @ORM\Index(name="i_asignacion_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Asignacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idasignacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ASIGNACION_IDASIGNACION_seq", allocationSize=1, initialValue=1)
     */
    private $idasignacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tarea_idtarea", type="integer", nullable=false)
     */
    private $tareaIdtarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="date", nullable=true)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=true)
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
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
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
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=true)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad", type="integer", nullable=true)
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
