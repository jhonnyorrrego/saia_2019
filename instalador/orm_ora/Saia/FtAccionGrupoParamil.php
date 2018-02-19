<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAccionGrupoParamil
 *
 * @ORM\Table(name="FT_ACCION_GRUPO_PARAMIL", indexes={@ORM\Index(name="i_ft_actualiz_grupo_armado", columns={"FT_ACTUALIZ_GRUPO_ARMADO"})})
 * @ORM\Entity
 */
class FtAccionGrupoParamil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ACTUALIZ_GRUPO_ARMADO", type="integer", nullable=true)
     */
    private $ftActualizGrupoArmado;

    /**
     * @var integer
     *
     * @ORM\Column(name="NOMBRE_ACCION", type="integer", nullable=true)
     */
    private $nombreAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="CALIFICA_ACCION", type="integer", nullable=true)
     */
    private $calificaAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="NO_RESPONDE", type="integer", nullable=true)
     */
    private $noResponde;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ACCION_GRUPO_PARAMIL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ACCION_GRUPO_PARAMIL_IDFT_A", allocationSize=1, initialValue=1)
     */
    private $idftAccionGrupoParamil;


}

