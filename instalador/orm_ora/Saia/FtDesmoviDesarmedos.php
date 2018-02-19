<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDesmoviDesarmedos
 *
 * @ORM\Table(name="FT_DESMOVI_DESARMEDOS")
 * @ORM\Entity
 */
class FtDesmoviDesarmedos
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
    private $serieIdserie = '210';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_DESMOVI_DESARMEDOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_DESMOVI_DESARMEDOS_IDFT_DES", allocationSize=1, initialValue=1)
     */
    private $idftDesmoviDesarmedos;

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
     * @ORM\Column(name="REUBICACION_ESTRUCTU", type="integer", nullable=true)
     */
    private $reubicacionEstructu;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_REUBICACION_ESTRUCTU", type="string", length=255, nullable=true)
     */
    private $otroReubicacionEstructu;


}

