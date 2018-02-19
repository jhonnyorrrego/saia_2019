<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAsignacionAbogado
 *
 * @ORM\Table(name="FT_ASIGNACION_ABOGADO", indexes={@ORM\Index(name="ft_asignacion_abogado_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_asignacion_a", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtAsignacionAbogado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CONCEPTO_COORDINADOR", type="integer", nullable=false)
     */
    private $ftConceptoCoordinador;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '485';

    /**
     * @var string
     *
     * @ORM\Column(name="ABOGADO_ASIGNADO", type="string", length=255, nullable=false)
     */
    private $abogadoAsignado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ESTIMADA", type="date", nullable=false)
     */
    private $fechaEstimada = 'SYSDATE';

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
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ASIGNACION", type="date", nullable=false)
     */
    private $fechaAsignacion = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ASIGNACION_ABOGADO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ASIGNACION_ABOGADO_IDFT_ASI", allocationSize=1, initialValue=1)
     */
    private $idftAsignacionAbogado;

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
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

