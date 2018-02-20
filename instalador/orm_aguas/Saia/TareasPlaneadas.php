<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasPlaneadas
 *
 * @ORM\Table(name="TAREAS_PLANEADAS")
 * @ORM\Entity
 */
class TareasPlaneadas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDTAREAS_PLANEADAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="TAREAS_PLANEADAS_IDTAREAS_PLAN", allocationSize=1, initialValue=1)
     */
    private $idtareasPlaneadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_TAREAS_LISTADO", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var string
     *
     * @ORM\Column(name="ROL_TAREAS", type="string", length=255, nullable=false)
     */
    private $rolTareas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_PLANEADA", type="date", nullable=true)
     */
    private $fechaPlaneada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_PLANEADA_FIN", type="date", nullable=true)
     */
    private $fechaPlaneadaFin = 'SYSDATE';


}
