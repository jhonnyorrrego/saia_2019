<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoSaia
 *
 * @ORM\Table(name="reemplazo_saia", indexes={@ORM\Index(name="i_reemplazo_sa_antiguo", columns={"antiguo"}), @ORM\Index(name="i_reemplazo_sa_nuevo", columns={"nuevo"})})
 * @ORM\Entity
 */
class ReemplazoSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_saia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreemplazoSaia;

    /**
     * @var integer
     *
     * @ORM\Column(name="antiguo", type="integer", nullable=false)
     */
    private $antiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nuevo", type="integer", nullable=false)
     */
    private $nuevo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="cargo_nuevo", type="integer", nullable=false)
     */
    private $cargoNuevo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_reemplazo", type="integer", nullable=false)
     */
    private $tipoReemplazo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", nullable=true)
     */
    private $observaciones;


}
