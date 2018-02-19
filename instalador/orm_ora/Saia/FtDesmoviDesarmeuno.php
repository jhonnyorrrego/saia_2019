<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtDesmoviDesarmeuno
 *
 * @ORM\Table(name="FT_DESMOVI_DESARMEUNO", indexes={@ORM\Index(name="ft_desmovi_desarmeuno_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_desmovi_desa", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtDesmoviDesarmeuno
{
    /**
     * @var string
     *
     * @ORM\Column(name="DESMOVILIZADO_GRUPO", type="string", length=255, nullable=false)
     */
    private $desmovilizadoGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="DEPARTAMUNICI_DESMOVI", type="string", length=255, nullable=false)
     */
    private $departamuniciDesmovi;

    /**
     * @var integer
     *
     * @ORM\Column(name="BARRIO_CASERIO_DESMOVI", type="integer", nullable=true)
     */
    private $barrioCaserioDesmovi;

    /**
     * @var string
     *
     * @ORM\Column(name="BARRIO_CASERIO_CUAL", type="string", length=255, nullable=true)
     */
    private $barrioCaserioCual;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_DESMOVILIZACION", type="integer", nullable=false)
     */
    private $tipoDesmovilizacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_DESMOVI_DESARMEUNO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_DESMOVI_DESARMEUNO_IDFT_DES", allocationSize=1, initialValue=1)
     */
    private $idftDesmoviDesarmeuno;

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
    private $serieIdserie = '162';

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
     * @ORM\Column(name="MOTIVO_DESMOVILIZA", type="integer", nullable=true)
     */
    private $motivoDesmoviliza;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_MOTIVO_DESMOVILIZA", type="string", length=255, nullable=true)
     */
    private $otroMotivoDesmoviliza;

    /**
     * @var integer
     *
     * @ORM\Column(name="IBA_DESMOVILIZAR", type="integer", nullable=true)
     */
    private $ibaDesmovilizar;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_IBA_DESMOVILIZAR", type="string", length=255, nullable=true)
     */
    private $otroIbaDesmovilizar;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTUVO_ACUERDO", type="integer", nullable=true)
     */
    private $estuvoAcuerdo;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTUVO_ACUERDO_PORQUE", type="text", nullable=true)
     */
    private $estuvoAcuerdoPorque = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="PERIODO_DIAS_DESMOVI", type="string", length=255, nullable=true)
     */
    private $periodoDiasDesmovi;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_MESES_DESMOVI", type="string", length=255, nullable=true)
     */
    private $tiempoMesesDesmovi;

    /**
     * @var string
     *
     * @ORM\Column(name="TIEMPO_DIAS_DESMOVI", type="string", length=255, nullable=true)
     */
    private $tiempoDiasDesmovi;

    /**
     * @var string
     *
     * @ORM\Column(name="PERIODO_MESES_DESMO", type="string", length=255, nullable=true)
     */
    private $periodoMesesDesmo;

    /**
     * @var integer
     *
     * @ORM\Column(name="TRASLADO_LUGAR_HABITU", type="integer", nullable=true)
     */
    private $trasladoLugarHabitu;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

