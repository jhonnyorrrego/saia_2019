<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EntidadPretexto
 *
 * @ORM\Table(name="entidad_pretexto")
 * @ORM\Entity
 */
class EntidadPretexto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="identidad_pretexto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $identidadPretexto;

    /**
     * @var integer
     *
     * @ORM\Column(name="pretexto_idpretexto", type="integer", nullable=false)
     */
    private $pretextoIdpretexto = '0';

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
    private $llaveEntidad = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha = 'SYSDATE';


}
