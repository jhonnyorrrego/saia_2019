<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoTiempo
 *
 * @ORM\Table(name="tareas_listado_tiempo")
 * @ORM\Entity
 */
class TareasListadoTiempo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_listado_tiempo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtareasListadoTiempo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_registro", type="date", nullable=true)
     */
    private $fechaRegistro = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="tiempo_registrado", type="integer", nullable=false)
     */
    private $tiempoRegistrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="comentario", type="text", nullable=true)
     */
    private $comentario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="date", nullable=false)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_final", type="date", nullable=false)
     */
    private $horaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_avance", type="string", length=9, nullable=false)
     */
    private $estadoAvance;


}
