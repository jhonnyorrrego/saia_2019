<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtLugaresRecorridos
 *
 * @ORM\Table(name="FT_LUGARES_RECORRIDOS", indexes={@ORM\Index(name="i_ft_desmovi_desarmeuno", columns={"FT_DESMOVI_DESARMEUNO"})})
 * @ORM\Entity
 */
class FtLugaresRecorridos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_DESMOVI_DESARMEUNO", type="integer", nullable=false)
     */
    private $ftDesmoviDesarmeuno;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARMUNICI_RECORRIDO", type="string", length=255, nullable=false)
     */
    private $deparmuniciRecorrido;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_LUGAR", type="string", length=255, nullable=true)
     */
    private $nombreLugar;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_PERMANEN_LUGAR", type="string", length=255, nullable=true)
     */
    private $tiempoPermanenLugar;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_LUGARES_RECORRIDOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_LUGARES_RECORRIDOS_IDFT_LUG", allocationSize=1, initialValue=1)
     */
    private $idftLugaresRecorridos;

    /**
     * @var string
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="string", length=255, nullable=true)
     */
    private $docPadreAcuerdo;


}

