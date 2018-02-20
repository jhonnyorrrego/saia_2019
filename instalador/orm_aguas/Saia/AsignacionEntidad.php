<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * AsignacionEntidad
 *
 * @ORM\Table(name="ASIGNACION_ENTIDAD")
 * @ORM\Entity
 */
class AsignacionEntidad
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDASIGNACION_ENTIDAD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ASIGNACION_ENTIDAD_IDASIGNACIO", allocationSize=1, initialValue=1)
     */
    private $idasignacionEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_ENTIDAD", type="integer", nullable=false)
     */
    private $llaveEntidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ASIGNACION_IDASIGNACION", type="integer", nullable=false)
     */
    private $asignacionIdasignacion = '0';


}

