<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadExpediente
 *
 * @ORM\Table(name="ENTIDAD_EXPEDIENTE")
 * @ORM\Entity
 */
class EntidadExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENTIDAD_EXPEDIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENTIDAD_EXPEDIENTE_IDENTIDAD_E", allocationSize=1, initialValue=1)
     */
    private $identidadExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="EXPEDIENTE_IDEXPEDIENTE", type="integer", nullable=false)
     */
    private $expedienteIdexpediente = '0';

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
     * @var string
     *
     * @ORM\Column(name="PERMISO", type="string", length=255, nullable=true)
     */
    private $permiso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;


}
