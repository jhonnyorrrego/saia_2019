<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtReintegracion
 *
 * @ORM\Table(name="FT_REINTEGRACION", indexes={@ORM\Index(name="ft_reintegracion_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_reintegracio", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_entrevista_estructurada", columns={"FT_ENTREVISTA_ESTRUCTURADA"})})
 * @ORM\Entity
 */
class FtReintegracion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="VIDA_GRUPO_PARA", type="integer", nullable=false)
     */
    private $vidaGrupoPara;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_VIDA_GRUPO_PARA", type="string", length=255, nullable=true)
     */
    private $otroVidaGrupoPara;

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
    private $serieIdserie = '220';

    /**
     * @var integer
     *
     * @ORM\Column(name="OPINION_GRUPO_PARA", type="integer", nullable=false)
     */
    private $opinionGrupoPara;

    /**
     * @var integer
     *
     * @ORM\Column(name="OPINION_DESMOV_PAZ", type="integer", nullable=false)
     */
    private $opinionDesmovPaz;

    /**
     * @var string
     *
     * @ORM\Column(name="ACCIONES_ESTADO", type="string", length=255, nullable=false)
     */
    private $accionesEstado;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ACCIONES_ESTADO", type="string", length=255, nullable=true)
     */
    private $otroAccionesEstado;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_REINTEGRACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_REINTEGRACION_IDFT_REINTEGR", allocationSize=1, initialValue=1)
     */
    private $idftReintegracion;

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
     * @ORM\Column(name="HORA_FINALIZACION", type="string", length=255, nullable=true)
     */
    private $horaFinalizacion = 'TO_CHAR(sysdate,\'hh24:mi:ss\')';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

