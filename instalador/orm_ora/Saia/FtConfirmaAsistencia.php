<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConfirmaAsistencia
 *
 * @ORM\Table(name="FT_CONFIRMA_ASISTENCIA", indexes={@ORM\Index(name="ft_confirma_asistencia_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_confirma_asi", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_convoca_telefonica", columns={"FT_CONVOCA_TELEFONICA"})})
 * @ORM\Entity
 */
class FtConfirmaAsistencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ASINGA_ENTREVISTADOR", type="integer", nullable=false)
     */
    private $ftAsingaEntrevistador;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '9';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CONFIRMACION", type="date", nullable=false)
     */
    private $fechaConfirmacion = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="ASISTIO", type="integer", nullable=false)
     */
    private $asistio;

    /**
     * @var string
     *
     * @ORM\Column(name="DOCUMENTO_SOPORTE", type="string", length=255, nullable=true)
     */
    private $documentoSoporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CONFIRMA_ASISTENCIA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CONFIRMA_ASISTENCIA_IDFT_CO", allocationSize=1, initialValue=1)
     */
    private $idftConfirmaAsistencia;

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
     * @ORM\Column(name="OBSERVACION_ASISTEN", type="string", length=3999, nullable=true)
     */
    private $observacionAsisten;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CONVOCA_TELEFONICA", type="integer", nullable=false)
     */
    private $ftConvocaTelefonica;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

