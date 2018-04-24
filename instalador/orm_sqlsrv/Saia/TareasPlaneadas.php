<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * TareasPlaneadas
 *
 * @ORM\Table(name="tareas_planeadas")
 * @ORM\Entity
 */
class TareasPlaneadas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtareas_planeadas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idtareasPlaneadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;

    /**
     * @var string
     *
     * @ORM\Column(name="rol_tareas", type="string", length=255, nullable=false)
     */
    private $rolTareas;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_planeada", type="datetime", nullable=true)
     */
    private $fechaPlaneada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_planeada_fin", type="datetime", nullable=true)
     */
    private $fechaPlaneadaFin;


}
