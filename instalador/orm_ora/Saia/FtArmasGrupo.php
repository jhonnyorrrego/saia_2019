<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtArmasGrupo
 *
 * @ORM\Table(name="FT_ARMAS_GRUPO", indexes={@ORM\Index(name="i_ft_caracteriza_intrafila", columns={"FT_CARACTERIZA_INTRAFILA"})})
 * @ORM\Entity
 */
class FtArmasGrupo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CARACTERIZA_INTRAFILA", type="integer", nullable=false)
     */
    private $ftCaracterizaIntrafila;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ARMAS_GRUPO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ARMAS_GRUPO_IDFT_ARMAS_GRUP", allocationSize=1, initialValue=1)
     */
    private $idftArmasGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ARMA_GRUPO", type="string", length=255, nullable=true)
     */
    private $tipoArmaGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_ARMA_GRUPO", type="string", length=255, nullable=true)
     */
    private $observacionArmaGrupo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_OTRO_GRUPO", type="integer", nullable=true)
     */
    private $tipoOtroGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_TIPO_OTRO_GRUPO", type="string", length=255, nullable=true)
     */
    private $otroTipoOtroGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_ARMAS_PERSONALES", type="string", length=255, nullable=true)
     */
    private $tipoArmasPersonales;

    /**
     * @var string
     *
     * @ORM\Column(name="CALIBRE_ARMA", type="string", length=255, nullable=true)
     */
    private $calibreArma;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;


}

