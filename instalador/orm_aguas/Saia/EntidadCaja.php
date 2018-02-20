<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadCaja
 *
 * @ORM\Table(name="ENTIDAD_CAJA")
 * @ORM\Entity
 */
class EntidadCaja
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENTIDAD_CAJA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENTIDAD_CAJA_IDENTIDAD_CAJA_se", allocationSize=1, initialValue=1)
     */
    private $identidadCaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_IDENTIDAD", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="CAJA_IDCAJA", type="integer", nullable=false)
     */
    private $cajaIdcaja = '0';

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
