<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadTarea
 *
 * @ORM\Table(name="ENTIDAD_TAREA")
 * @ORM\Entity
 */
class EntidadTarea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENTIDAD_TAREA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENTIDAD_TAREA_IDENTIDAD_TAREA_", allocationSize=1, initialValue=1)
     */
    private $identidadTarea;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="integer", nullable=false)
     */
    private $llaveEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="TAREA_IDTAREA", type="integer", nullable=false)
     */
    private $tareaIdtarea;


}

