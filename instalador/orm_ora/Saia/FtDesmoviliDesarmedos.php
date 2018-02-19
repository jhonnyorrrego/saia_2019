<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDesmoviliDesarmedos
 *
 * @ORM\Table(name="FT_DESMOVILI_DESARMEDOS", indexes={@ORM\Index(name="ft_desmovili_desarmedos_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_desmovili_de", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtDesmoviliDesarmedos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     */
    private $ftEntrevistaEstructurada;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '215';

    /**
     * @var integer
     *
     * @ORM\Column(name="REUBICACION_ESTRUCTU", type="integer", nullable=true)
     */
    private $reubicacionEstructu;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_REUBICACION_ESTRUCTU", type="string", length=255, nullable=true)
     */
    private $otroReubicacionEstructu;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_DESMOVILI_DESARMEDOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_DESMOVILI_DESARMEDOS_IDFT_D", allocationSize=1, initialValue=1)
     */
    private $idftDesmoviliDesarmedos;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENCABEZADO", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMA", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERSONA_NO_DESMOVI", type="integer", nullable=false)
     */
    private $personaNoDesmovi;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_PERSONA_NO_DESMOVI", type="string", length=255, nullable=true)
     */
    private $otroPersonaNoDesmovi;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_NODESMOVILIZA_PORQUE", type="string", length=255, nullable=true)
     */
    private $otroNodesmovilizaPorque;

    /**
     * @var string
     *
     * @ORM\Column(name="POBLACION_DESMOVILIZA", type="string", length=255, nullable=true)
     */
    private $poblacionDesmoviliza;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_POBLACION_DESMOVILIZA", type="string", length=255, nullable=true)
     */
    private $otroPoblacionDesmoviliza;

    /**
     * @var string
     *
     * @ORM\Column(name="NODESMOVILIZA_PORQUE", type="string", length=255, nullable=true)
     */
    private $nodesmovilizaPorque;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

