<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadCaja
 *
 * @ORM\Table(name="entidad_caja")
 * @ORM\Entity
 */
class EntidadCaja
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identidad_caja", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identidadCaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="caja_idcaja", type="integer", nullable=false)
     */
    private $cajaIdcaja = '0';

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
     * @var string
     *
     * @ORM\Column(name="permiso", type="string", length=255, nullable=true)
     */
    private $permiso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;


}
