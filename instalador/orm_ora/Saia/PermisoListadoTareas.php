<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoListadoTareas
 *
 * @ORM\Table(name="permiso_listado_tareas")
 * @ORM\Entity
 */
class PermisoListadoTareas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_listado_tareas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpermisoListadoTareas;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_listado_tareas", type="integer", nullable=false)
     */
    private $fkListadoTareas = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad", type="integer", nullable=false)
     */
    private $llaveEntidad = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';


}
