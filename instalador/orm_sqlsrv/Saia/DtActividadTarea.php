<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DtActividadTarea
 *
 * @ORM\Table(name="dt_actividad_tarea")
 * @ORM\Entity
 */
class DtActividadTarea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddt_actividad_tarea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddtActividadTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_tareas_listado", type="integer", nullable=false)
     */
    private $fkTareasListado;


}

