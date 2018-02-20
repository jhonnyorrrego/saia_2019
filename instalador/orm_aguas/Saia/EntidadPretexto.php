<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadPretexto
 *
 * @ORM\Table(name="ENTIDAD_PRETEXTO")
 * @ORM\Entity
 */
class EntidadPretexto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENTIDAD_PRETEXTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENTIDAD_PRETEXTO_IDENTIDAD_PRE", allocationSize=1, initialValue=1)
     */
    private $identidadPretexto;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRETEXTO_IDPRETEXTO", type="integer", nullable=false)
     */
    private $pretextoIdpretexto = '0';

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
    private $llaveEntidad = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';


}
