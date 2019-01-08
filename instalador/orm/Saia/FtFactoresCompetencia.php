<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFactoresCompetencia
 *
 * @ORM\Table(name="ft_factores_competencia")
 * @ORM\Entity
 */
class FtFactoresCompetencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_factores_competencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFactoresCompetencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="factor_competencia", type="integer", nullable=false)
     */
    private $factorCompetencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_ingreso_personal", type="integer", nullable=false)
     */
    private $ftIngresoPersonal;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones_acciones", type="text", length=65535, nullable=true)
     */
    private $observacionesAcciones;

    /**
     * @var string
     *
     * @ORM\Column(name="real_factor", type="text", length=65535, nullable=true)
     */
    private $realFactor;

    /**
     * @var string
     *
     * @ORM\Column(name="requerido", type="text", length=65535, nullable=true)
     */
    private $requerido;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}

