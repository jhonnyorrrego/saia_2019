<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoSaia
 *
 * @ORM\Table(name="REEMPLAZO_SAIA", indexes={@ORM\Index(name="i_reemplazo_sa_antiguo", columns={"ANTIGUO"}), @ORM\Index(name="i_reemplazo_sa_nuevo", columns={"NUEVO"})})
 * @ORM\Entity
 */
class ReemplazoSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDREEMPLAZO_SAIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="REEMPLAZO_SAIA_IDREEMPLAZO_SAI", allocationSize=1, initialValue=1)
     */
    private $idreemplazoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANTIGUO", type="integer", nullable=false)
     */
    private $antiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="NUEVO", type="integer", nullable=false)
     */
    private $nuevo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIO", type="date", nullable=false)
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
     * @ORM\Column(name="CARGO_NUEVO", type="integer", nullable=false)
     */
    private $cargoNuevo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=1, nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_REEMPLAZO", type="integer", nullable=false)
     */
    private $tipoReemplazo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones;


}
