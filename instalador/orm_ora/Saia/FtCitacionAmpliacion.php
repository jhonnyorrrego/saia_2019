<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCitacionAmpliacion
 *
 * @ORM\Table(name="FT_CITACION_AMPLIACION", indexes={@ORM\Index(name="ft_citacion_ampliacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_citacion_amp", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtCitacionAmpliacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '244';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CITACION_AMPLIACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CITACION_AMPLIACION_IDFT_CI", allocationSize=1, initialValue=1)
     */
    private $idftCitacionAmpliacion;

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
     * @var \DateTime
     *
     * @ORM\Column(name="HORA_CITACION", type="date", nullable=false)
     */
    private $horaCitacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="MOTIVO_REPROGRAMACION", type="string", length=255, nullable=false)
     */
    private $motivoReprogramacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CONFIRMA_ASISTENCIA", type="integer", nullable=false)
     */
    private $ftConfirmaAsistencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CITACION_AMPLIA", type="date", nullable=false)
     */
    private $fechaCitacionAmplia = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_CITACION_AMPLIA", type="string", length=255, nullable=false)
     */
    private $lugarCitacionAmplia;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_CITACION", type="string", length=255, nullable=false)
     */
    private $numeroCitacion;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_REPROGRAMACION", type="string", length=255, nullable=false)
     */
    private $ciudadReprogramacion;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_DILIGEN_REPROG", type="string", length=255, nullable=true)
     */
    private $ciudadDiligenReprog;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_CITACION", type="integer", nullable=true)
     */
    private $tipoCitacion;

    /**
     * @var string
     *
     * @ORM\Column(name="CARGA_SOPORTE", type="string", length=255, nullable=true)
     */
    private $cargaSoporte;


}

