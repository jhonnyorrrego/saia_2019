<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAudiosGrabados
 *
 * @ORM\Table(name="FT_AUDIOS_GRABADOS", indexes={@ORM\Index(name="ft_audios_grabados_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_audios_graba", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_consentimiento_firma", columns={"FT_CONSENTIMIENTO_FIRMA"})})
 * @ORM\Entity
 */
class FtAudiosGrabados
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
    private $serieIdserie = '243';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_AUDIOS", type="date", nullable=false)
     */
    private $fechaAudios = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="AUDIOS_ANEXOS", type="text", nullable=true)
     */
    private $audiosAnexos = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_AUDIOS_GRABADOS", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_AUDIOS_GRABADOS_IDFT_AUDIOS", allocationSize=1, initialValue=1)
     */
    private $idftAudiosGrabados;

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
     * @ORM\Column(name="FT_CONSENTIMIENTO_FIRMA", type="integer", nullable=true)
     */
    private $ftConsentimientoFirma;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

