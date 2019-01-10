<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoRecur
 *
 * @ORM\Table(name="tareas_listado_recur")
 * @ORM\Entity
 */
class TareasListadoRecur
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado_recur", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtareasListadoRecur;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var integer
     *
     * @ORM\Column(name="recurrencia", type="integer", nullable=false)
     */
    private $recurrencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="repetir_cada", type="integer", nullable=false)
     */
    private $repetirCada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="empieza_el", type="date", nullable=false)
     */
    private $empiezaEl;

    /**
     * @var integer
     *
     * @ORM\Column(name="finaliza_el", type="integer", nullable=false)
     */
    private $finalizaEl;

    /**
     * @var integer
     *
     * @ORM\Column(name="finaliza_el_repeticiones", type="integer", nullable=true)
     */
    private $finalizaElRepeticiones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finaliza_el_fecha", type="date", nullable=true)
     */
    private $finalizaElFecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="repeticiones_ejecutada", type="integer", nullable=false)
     */
    private $repeticionesEjecutada = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="repetir_mes", type="integer", nullable=true)
     */
    private $repetirMes;

    /**
     * @var string
     *
     * @ORM\Column(name="dias_semana", type="string", length=255, nullable=true)
     */
    private $diasSemana;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ejecuta_proxima", type="date", nullable=false)
     */
    private $ejecutaProxima;


}

