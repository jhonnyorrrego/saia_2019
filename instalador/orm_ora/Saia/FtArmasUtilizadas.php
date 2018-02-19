<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtArmasUtilizadas
 *
 * @ORM\Table(name="FT_ARMAS_UTILIZADAS", indexes={@ORM\Index(name="armas_util_intraf_idx1", columns={"FT_CARACTERIZA_INTRAFILA"})})
 * @ORM\Entity
 */
class FtArmasUtilizadas
{
    /**
     * @var string
     *
     * @ORM\Column(name="GAI_CALIBRE", type="string", length=255, nullable=true)
     */
    private $gaiCalibre;

    /**
     * @var string
     *
     * @ORM\Column(name="ARMA_UTILIZADA_GRUPO", type="string", length=255, nullable=true)
     */
    private $armaUtilizadaGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CARACTERIZA_INTRAFILA", type="integer", nullable=false)
     */
    private $ftCaracterizaIntrafila;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSONAL_CALIBRE", type="string", length=255, nullable=true)
     */
    private $personalCalibre;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ARMAS_UTILIZADAS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ARMAS_UTILIZADAS_IDFT_ARMAS", allocationSize=1, initialValue=1)
     */
    private $idftArmasUtilizadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="OTRO_TIPO", type="integer", nullable=true)
     */
    private $otroTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_OTRO_TIPO", type="string", length=255, nullable=true)
     */
    private $otroOtroTipo;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_ARMAS", type="string", length=255, nullable=true)
     */
    private $observacionArmas;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;


}

