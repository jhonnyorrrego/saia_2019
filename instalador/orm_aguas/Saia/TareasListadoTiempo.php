<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasListadoTiempo
 *
 * @ORM\Table(name="TAREAS_LISTADO_TIEMPO")
 * @ORM\Entity
 */
class TareasListadoTiempo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_LISTADO_TIEMPO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_LISTADO_TIEMPO_IDTAREAS", allocationSize=1, initialValue=1)
     */
    private $idtareasListadoTiempo;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_TAREAS_LISTADO", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REGISTRO", type="date", nullable=true)
     */
    private $fechaRegistro = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIEMPO_REGISTRADO", type="integer", nullable=false)
     */
    private $tiempoRegistrado;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="COMENTARIO", type="text", nullable=true)
     */
    private $comentario;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIO", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HORA_INICIO", type="date", nullable=false)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HORA_FINAL", type="date", nullable=false)
     */
    private $horaFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_AVANCE", type="string", length=9, nullable=false)
     */
    private $estadoAvance;


}
