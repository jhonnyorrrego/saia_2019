<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtInfoProcesoTranscrip
 *
 * @ORM\Table(name="FT_INFO_PROCESO_TRANSCRIP", indexes={@ORM\Index(name="ft_info_proceso_transcrip_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_info_proceso", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_concepto_entrevista", columns={"FT_CONCEPTO_ENTREVISTA"})})
 * @ORM\Entity
 */
class FtInfoProcesoTranscrip
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CONCEPTO_ENTREVISTA", type="integer", nullable=false)
     */
    private $ftConceptoEntrevista;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '302';

    /**
     * @var integer
     *
     * @ORM\Column(name="RELATO_TRANSCRIPCION", type="integer", nullable=false)
     */
    private $relatoTranscripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_INFO_PROCESO_TRANSCRIP", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_INFO_PROCESO_TRANSCRIP_IDFT", allocationSize=1, initialValue=1)
     */
    private $idftInfoProcesoTranscrip;

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
     * @ORM\Column(name="OBSERVACION_TRANSCRIP", type="string", length=3999, nullable=true)
     */
    private $observacionTranscrip;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

