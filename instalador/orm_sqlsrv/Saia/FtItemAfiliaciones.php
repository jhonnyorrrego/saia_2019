<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemAfiliaciones
 *
 * @ORM\Table(name="ft_item_afiliaciones")
 * @ORM\Entity
 */
class FtItemAfiliaciones
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_afiliaciones", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemAfiliaciones;

    /**
     * @var integer
     *
     * @ORM\Column(name="afiliacion", type="integer", nullable=false)
     */
    private $afiliacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_validacion_tramite", type="integer", nullable=false)
     */
    private $ftValidacionTramite;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="valor_afiliacion", type="string", length=255, nullable=false)
     */
    private $valorAfiliacion;


}

