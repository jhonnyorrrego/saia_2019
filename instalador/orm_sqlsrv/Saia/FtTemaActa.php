<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTemaActa
 *
 * @ORM\Table(name="ft_tema_acta")
 * @ORM\Entity
 */
class FtTemaActa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_tema_acta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftTemaActa;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_acta_reunion", type="integer", nullable=false)
     */
    private $ftActaReunion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="tema", type="string", length=255, nullable=false)
     */
    private $tema;


}

