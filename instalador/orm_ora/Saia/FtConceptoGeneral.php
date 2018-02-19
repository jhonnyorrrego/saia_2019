<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConceptoGeneral
 *
 * @ORM\Table(name="FT_CONCEPTO_GENERAL", indexes={@ORM\Index(name="ft_concepto_general_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_concepto_gen", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_elementos_entrevista", columns={"FT_ELEMENTOS_ENTREVISTA"})})
 * @ORM\Entity
 */
class FtConceptoGeneral
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
    private $serieIdserie = '305';

    /**
     * @var string
     *
     * @ORM\Column(name="TEMAS_ABORDAR_FUTURO", type="text", nullable=false)
     */
    private $temasAbordarFuturo = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="INCONSISTENCIAS_INFO", type="text", nullable=true)
     */
    private $inconsistenciasInfo = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CONCEPTO_GENERAL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CONCEPTO_GENERAL_IDFT_CONCE", allocationSize=1, initialValue=1)
     */
    private $idftConceptoGeneral;

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
     * @ORM\Column(name="FT_ELEMENTOS_ENTREVISTA", type="integer", nullable=false)
     */
    private $ftElementosEntrevista;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

