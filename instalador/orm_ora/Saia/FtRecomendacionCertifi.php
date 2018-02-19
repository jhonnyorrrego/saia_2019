<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRecomendacionCertifi
 *
 * @ORM\Table(name="FT_RECOMENDACION_CERTIFI", indexes={@ORM\Index(name="ft_recomendacion_certifi_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_recomendacio", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_valoracion_asignado", columns={"FT_VALORACION_ASIGNADO"}), @ORM\Index(name="i_ft_reporte_validez", columns={"FT_REPORTE_VALIDEZ"})})
 * @ORM\Entity
 */
class FtRecomendacionCertifi
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_VALORACION_ASIGNADO", type="integer", nullable=false)
     */
    private $ftValoracionAsignado;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '321';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RECOMENDACION", type="date", nullable=false)
     */
    private $fechaRecomendacion = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="CONCEPTO_VALORACION", type="integer", nullable=false)
     */
    private $conceptoValoracion;

    /**
     * @var string
     *
     * @ORM\Column(name="JUSFITICA_RECOMENDA", type="text", nullable=true)
     */
    private $jusfiticaRecomenda = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_RECOMENDACION_CERTIFI", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_RECOMENDACION_CERTIFI_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftRecomendacionCertifi;

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
     * @ORM\Column(name="FT_REPORTE_VALIDEZ", type="integer", nullable=false)
     */
    private $ftReporteValidez;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

