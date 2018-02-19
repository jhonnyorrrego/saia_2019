<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConfirmaAsisteAmpli
 *
 * @ORM\Table(name="FT_CONFIRMA_ASISTE_AMPLI", indexes={@ORM\Index(name="i_ft_citacion_ampliacion", columns={"FT_CITACION_AMPLIACION"})})
 * @ORM\Entity
 */
class FtConfirmaAsisteAmpli
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CITACION_AMPLIACION", type="integer", nullable=false)
     */
    private $ftCitacionAmpliacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '245';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CONFIRMA_ASISTE", type="date", nullable=false)
     */
    private $fechaConfirmaAsiste = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="ASISTIO_CONFIRMA_AMPLI", type="integer", nullable=false)
     */
    private $asistioConfirmaAmpli;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_SOPORTE", type="string", length=255, nullable=true)
     */
    private $documentoSoporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CONFIRMA_ASISTE_AMPLI", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CONFIRMA_ASISTE_AMPLI_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftConfirmaAsisteAmpli;

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
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_REPROGRAMA", type="string", length=3999, nullable=true)
     */
    private $observacionReprograma;


}

