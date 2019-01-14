<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAperturaCierreActa
 *
 * @ORM\Table(name="ft_apertura_cierre_acta")
 * @ORM\Entity
 */
class FtAperturaCierreActa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_apertura_cierre_acta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftAperturaCierreActa;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="responsable", type="integer", nullable=false)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="apertura_cierre", type="integer", nullable=false)
     */
    private $aperturaCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_acta_reunion", type="integer", nullable=false)
     */
    private $ftActaReunion;


}

