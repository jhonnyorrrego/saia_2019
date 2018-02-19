<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reemplazo
 *
 * @ORM\Table(name="REEMPLAZO")
 * @ORM\Entity
 */
class Reemplazo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREEMPLAZO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REEMPLAZO_IDREEMPLAZO_seq", allocationSize=1, initialValue=1)
     */
    private $idreemplazo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANTIGUO", type="integer", nullable=true)
     */
    private $antiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="NUEVO", type="integer", nullable=true)
     */
    private $nuevo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIO", type="date", nullable=true)
     */
    private $fechaInicio = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FIN", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="CARGO_NUEVO", type="integer", nullable=true)
     */
    private $cargoNuevo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ACTIVO", type="string", length=1, nullable=true)
     */
    private $activo = '1';


}
