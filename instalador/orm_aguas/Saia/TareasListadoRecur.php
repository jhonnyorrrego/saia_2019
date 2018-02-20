<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoRecur
 *
 * @ORM\Table(name="TAREAS_LISTADO_RECUR")
 * @ORM\Entity
 */
class TareasListadoRecur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_LISTADO_RECUR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_LISTADO_RECUR_IDTAREAS_", allocationSize=1, initialValue=1)
     */
    private $idtareasListadoRecur;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_TAREAS_LISTADO", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="RECURRENCIA", type="integer", nullable=false)
     */
    private $recurrencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="REPETIR_CADA", type="integer", nullable=false)
     */
    private $repetirCada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EMPIEZA_EL", type="date", nullable=false)
     */
    private $empiezaEl;

    /**
     * @var integer
     *
     * @ORM\Column(name="FINALIZA_EL", type="integer", nullable=false)
     */
    private $finalizaEl;

    /**
     * @var integer
     *
     * @ORM\Column(name="FINALIZA_EL_REPETICIONES", type="integer", nullable=true)
     */
    private $finalizaElRepeticiones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FINALIZA_EL_FECHA", type="date", nullable=true)
     */
    private $finalizaElFecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="REPETICIONES_EJECUTADA", type="integer", nullable=false)
     */
    private $repeticionesEjecutada = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="REPETIR_MES", type="integer", nullable=true)
     */
    private $repetirMes;

    /**
     * @var string
     *
     * @ORM\Column(name="DIAS_SEMANA", type="string", length=255, nullable=true)
     */
    private $diasSemana;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="EJECUTA_PROXIMA", type="date", nullable=false)
     */
    private $ejecutaProxima;


}
