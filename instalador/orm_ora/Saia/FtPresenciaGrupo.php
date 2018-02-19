<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPresenciaGrupo
 *
 * @ORM\Table(name="FT_PRESENCIA_GRUPO", indexes={@ORM\Index(name="i_ft_entorno_socioecono", columns={"FT_ENTORNO_SOCIOECONO"})})
 * @ORM\Entity
 */
class FtPresenciaGrupo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTORNO_SOCIOECONO", type="integer", nullable=false)
     */
    private $ftEntornoSocioecono;

    /**
     * @var integer
     *
     * @ORM\Column(name="GRUPO_ARMADO", type="integer", nullable=true)
     */
    private $grupoArmado;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_GRUPO_ARMADO", type="string", length=255, nullable=true)
     */
    private $otroGrupoArmado;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_GRUPO_ARMADO", type="string", length=255, nullable=true)
     */
    private $nombreGrupoArmado;

    /**
     * @var integer
     *
     * @ORM\Column(name="NOSABE_NORESPONDE", type="integer", nullable=true)
     */
    private $nosabeNoresponde;

    /**
     * @var string
     *
     * @ORM\Column(name="QUE_ANIO", type="string", length=255, nullable=true)
     */
    private $queAnio;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_PRESENCIA_GRUPO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_PRESENCIA_GRUPO_IDFT_PRESEN", allocationSize=1, initialValue=1)
     */
    private $idftPresenciaGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="HASTA_QUE_ANIO", type="string", length=255, nullable=true)
     */
    private $hastaQueAnio;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;


}

