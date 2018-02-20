<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadTarea
 *
 * @ORM\Table(name="entidad_tarea")
 * @ORM\Entity
 */
class EntidadTarea
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identidad_tarea", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ENTIDAD_TAREA_IDENTIDAD_TAREA_", allocationSize=1, initialValue=1)
     */
    private $identidadTarea;

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
     * @var integer
     *
     * @ORM\Column(name="tarea_idtarea", type="integer", nullable=false)
     */
    private $tareaIdtarea;


}

