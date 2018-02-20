<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoListadoTareas
 *
 * @ORM\Table(name="PERMISO_LISTADO_TAREAS")
 * @ORM\Entity
 */
class PermisoListadoTareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERMISO_LISTADO_TAREAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERMISO_LISTADO_TAREAS_IDPERMI", allocationSize=1, initialValue=1)
     */
    private $idpermisoListadoTareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_LISTADO_TAREAS", type="integer", nullable=false)
     */
    private $fkListadoTareas = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="integer", nullable=false)
     */
    private $llaveEntidad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';


}
