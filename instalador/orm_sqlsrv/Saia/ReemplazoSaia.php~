<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoSaia
 *
 * @ORM\Table(name="reemplazo_saia")
 * @ORM\Entity
 */
class ReemplazoSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_saia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
     */
    private $fechaFin;

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
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="procesado", type="integer", nullable=false)
     */
    private $procesado = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_reemplazo", type="datetime", nullable=false)
     */
    private $fechaReemplazo = 'CURRENT_TIMESTAMP';


}

