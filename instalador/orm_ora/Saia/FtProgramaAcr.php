<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtProgramaAcr
 *
 * @ORM\Table(name="FT_PROGRAMA_ACR", indexes={@ORM\Index(name="i_ft_perfil_actual", columns={"FT_PERFIL_ACTUAL"})})
 * @ORM\Entity
 */
class FtProgramaAcr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_PERFIL_ACTUAL", type="integer", nullable=false)
     */
    private $ftPerfilActual;

    /**
     * @var integer
     *
     * @ORM\Column(name="NOMBRE_PROGRAMA_ACR", type="integer", nullable=false)
     */
    private $nombreProgramaAcr;

    /**
     * @var integer
     *
     * @ORM\Column(name="ACTIVO_PROGRAMA", type="integer", nullable=true)
     */
    private $activoPrograma;

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICACION_PROGRAMA", type="integer", nullable=true)
     */
    private $calificacionPrograma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_PROGRAMA_ACR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_PROGRAMA_ACR_IDFT_PROGRAMA_", allocationSize=1, initialValue=1)
     */
    private $idftProgramaAcr;


}

