<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAdicionarInducc
 *
 * @ORM\Table(name="ft_adicionar_inducc")
 * @ORM\Entity
 */
class FtAdicionarInducc
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_adicionar_inducc", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAdicionarInducc;

    /**
     * @var integer
     *
     * @ORM\Column(name="area_responsa", type="integer", nullable=false)
     */
    private $areaResponsa;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_horario", type="datetime", nullable=false)
     */
    private $fechaHorario;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma_induccion", type="integer", nullable=true)
     */
    private $firmaInduccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_plan_induccion", type="integer", nullable=false)
     */
    private $ftPlanInduccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;


}

