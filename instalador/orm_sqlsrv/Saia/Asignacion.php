<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asignacion
 *
 * @ORM\Table(name="asignacion", indexes={@ORM\Index(name="i_asignacion_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class Asignacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idasignacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @ORM\Column(name="fecha_inicial", type="datetime", nullable=true)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="datetime", nullable=true)
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
     * @ORM\Column(name="estado", type="string", nullable=false)
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
     * @var boolean
     *
     * @ORM\Column(name="reprograma", type="boolean", nullable=true)
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
