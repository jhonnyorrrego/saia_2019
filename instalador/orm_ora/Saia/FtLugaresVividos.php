<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtLugaresVividos
 *
 * @ORM\Table(name="FT_LUGARES_VIVIDOS", indexes={@ORM\Index(name="i_ft_desmovi_desarmecuatro", columns={"FT_DESMOVI_DESARMECUATRO"})})
 * @ORM\Entity
 */
class FtLugaresVividos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_DESMOVI_DESARMECUATRO", type="integer", nullable=false)
     */
    private $ftDesmoviDesarmecuatro;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARMUNICI_VIVIDO", type="string", length=255, nullable=false)
     */
    private $deparmuniciVivido;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_LUGARES_VIVIDOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_LUGARES_VIVIDOS_IDFT_LUGARE", allocationSize=1, initialValue=1)
     */
    private $idftLugaresVividos;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;


}

