<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsignacionEntidad
 *
 * @ORM\Table(name="asignacion_entidad")
 * @ORM\Entity
 */
class AsignacionEntidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idasignacion_entidad", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ASIGNACION_ENTIDAD_IDASIGNACIO", allocationSize=1, initialValue=1)
     */
    private $idasignacionEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad", type="integer", nullable=false)
     */
    private $llaveEntidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="asignacion_idasignacion", type="integer", nullable=false)
     */
    private $asignacionIdasignacion = '0';


}

