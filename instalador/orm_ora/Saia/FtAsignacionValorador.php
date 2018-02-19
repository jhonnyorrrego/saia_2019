<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAsignacionValorador
 *
 * @ORM\Table(name="FT_ASIGNACION_VALORADOR", indexes={@ORM\Index(name="ft_asignacion_valorador_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_asignacion_v", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_elementos_examen", columns={"FT_ELEMENTOS_EXAMEN"})})
 * @ORM\Entity
 */
class FtAsignacionValorador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '310';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_VALORACION", type="date", nullable=false)
     */
    private $fechaValoracion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="VALORADOR_ASIGNADO", type="string", length=255, nullable=false)
     */
    private $valoradorAsignado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ESTIMADA_VALORA", type="date", nullable=false)
     */
    private $fechaEstimadaValora = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ASIGNACION_VALORADOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ASIGNACION_VALORADOR_IDFT_A", allocationSize=1, initialValue=1)
     */
    private $idftAsignacionValorador;

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
     * @ORM\Column(name="FT_ELEMENTOS_EXAMEN", type="integer", nullable=true)
     */
    private $ftElementosExamen;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

