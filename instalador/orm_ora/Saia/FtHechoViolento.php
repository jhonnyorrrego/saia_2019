<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtHechoViolento
 *
 * @ORM\Table(name="FT_HECHO_VIOLENTO", indexes={@ORM\Index(name="i_ft_entorno_familiar", columns={"FT_ENTORNO_FAMILIAR"})})
 * @ORM\Entity
 */
class FtHechoViolento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XXVII_ACCION", type="integer", nullable=false)
     */
    private $preXxviiAccion;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PRE_XXVII_ACCION", type="string", length=255, nullable=true)
     */
    private $otroPreXxviiAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTORNO_FAMILIAR", type="integer", nullable=false)
     */
    private $ftEntornoFamiliar;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_HECHO_VIOLENTO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_HECHO_VIOLENTO_IDFT_HECHO_V", allocationSize=1, initialValue=1)
     */
    private $idftHechoViolento;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXVII_PARENTESCO", type="string", length=255, nullable=true)
     */
    private $preXxviiParentesco;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRE_XXVII_ANIOHECHO", type="integer", nullable=true)
     */
    private $preXxviiAniohecho;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXVII_LUGAR", type="string", length=255, nullable=true)
     */
    private $preXxviiLugar;

    /**
     * @var string
     *
     * @ORM\Column(name="PRE_XXVII_GRUPOARMADO", type="string", length=255, nullable=true)
     */
    private $preXxviiGrupoarmado;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;


}

