<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConsentimientoFirma
 *
 * @ORM\Table(name="FT_CONSENTIMIENTO_FIRMA", indexes={@ORM\Index(name="ft_consentimiento_firma_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_consentimien", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtConsentimientoFirma
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
    private $serieIdserie = '241';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CONSENTIMIENTO", type="date", nullable=false)
     */
    private $fechaConsentimiento = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_ANEXO", type="string", length=255, nullable=true)
     */
    private $documentoAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CONSENTIMIENTO_FIRMA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CONSENTIMIENTO_FIRMA_IDFT_C", allocationSize=1, initialValue=1)
     */
    private $idftConsentimientoFirma;

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
     * @ORM\Column(name="REGISTRO_ASISTENCIA", type="string", length=255, nullable=true)
     */
    private $registroAsistencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

