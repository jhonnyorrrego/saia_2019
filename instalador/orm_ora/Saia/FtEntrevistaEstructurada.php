<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEntrevistaEstructurada
 *
 * @ORM\Table(name="FT_ENTREVISTA_ESTRUCTURADA", indexes={@ORM\Index(name="ft_entrevista_estructurada_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_entrevista_e", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_confirma_asistencia", columns={"FT_CONFIRMA_ASISTENCIA"})})
 * @ORM\Entity
 */
class FtEntrevistaEstructurada
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_REALIZACION", type="date", nullable=false)
     */
    private $fechaRealizacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_REALIZACION", type="string", length=255, nullable=false)
     */
    private $lugarRealizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_ENTREVISTADOR", type="string", length=255, nullable=false)
     */
    private $nombreEntrevistador;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGO_ENTREVISTADOR", type="string", length=255, nullable=true)
     */
    private $cargoEntrevistador;

    /**
     * @var string
     *
     * @ORM\Column(name="REGIONAL_DAV", type="string", length=255, nullable=false)
     */
    private $regionalDav;

    /**
     * @var string
     *
     * @ORM\Column(name="HORA_INICIO", type="string", length=255, nullable=false)
     */
    private $horaInicio = 'TO_CHAR(sysdate,\'hh24:mi:ss\')';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ENTREVISTA_ESTRUCTURADA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ENTREVISTA_ESTRUCTURADA_IDF", allocationSize=1, initialValue=1)
     */
    private $idftEntrevistaEstructurada;

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
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '23';

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_IDENTIFICACION", type="string", length=255, nullable=false)
     */
    private $codigoIdentificacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CONFIRMA_ASISTENCIA", type="integer", nullable=false)
     */
    private $ftConfirmaAsistencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

