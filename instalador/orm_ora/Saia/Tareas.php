<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tareas
 *
 * @ORM\Table(name="TAREAS")
 * @ORM\Entity
 */
class Tareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_IDTAREAS_seq", allocationSize=1, initialValue=1)
     */
    private $idtareas;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=true)
     */
    private $etiqueta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_VENCIMIENTO", type="date", nullable=true)
     */
    private $fechaVencimiento = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="ASIGNADA_POR", type="integer", nullable=true)
     */
    private $asignadaPor;

    /**
     * @var string
     *
     * @ORM\Column(name="ASIGNADA_A", type="string", length=255, nullable=true)
     */
    private $asignadaA;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=true)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden;


}
