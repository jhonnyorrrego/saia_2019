<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRadicacionSalida
 *
 * @ORM\Table(name="FT_RADICACION_SALIDA", indexes={@ORM\Index(name="ft_radicacion_salida_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_radicacion_s", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtRadicacionSalida
{
    /**
     * @var string
     *
     * @ORM\Column(name="IDFLUJO", type="string", length=255, nullable=true)
     */
    private $idflujo;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '641';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_RADICACION_SALIDA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_RADICACION_SALIDA_IDFT_RADI", allocationSize=1, initialValue=1)
     */
    private $idftRadicacionSalida;

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
     * @ORM\Column(name="CIUDAD_DESTINO", type="string", length=255, nullable=true)
     */
    private $ciudadDestino;

    /**
     * @var string
     *
     * @ORM\Column(name="AREA_RESPONSABLE", type="string", length=255, nullable=false)
     */
    private $areaResponsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_MENSAJERIA", type="integer", nullable=true)
     */
    private $tipoMensajeria = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="NUMERO_RADICADO", type="integer", nullable=true)
     */
    private $numeroRadicado;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS_FISICOS", type="string", length=255, nullable=true)
     */
    private $anexosFisicos;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_ANEXOS", type="string", length=1000, nullable=true)
     */
    private $descripcionAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="PERSONA_NATURAL", type="string", length=255, nullable=false)
     */
    private $personaNatural;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RADICACION_ENTRADA", type="date", nullable=false)
     */
    private $fechaRadicacionEntrada = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="MENSAJEROS", type="integer", nullable=true)
     */
    private $mensajeros;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO_RADICADO", type="string", length=255, nullable=true)
     */
    private $estadoRadicado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION_SALIDA", type="text", nullable=false)
     */
    private $descripcionSalida = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="ANEXOS_FISICOS_R", type="string", length=255, nullable=true)
     */
    private $anexosFisicosR;

    /**
     * @var string
     *
     * @ORM\Column(name="OTRO_ANEXO_FISICO", type="string", length=255, nullable=true)
     */
    private $otroAnexoFisico;


}

