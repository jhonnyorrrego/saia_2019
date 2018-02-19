<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtGestionCitacion
 *
 * @ORM\Table(name="FT_GESTION_CITACION", indexes={@ORM\Index(name="ft_gestion_citacion_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_gestion_cita", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_notifica_inicio_proce", columns={"FT_NOTIFICA_INICIO_PROCE"})})
 * @ORM\Entity
 */
class FtGestionCitacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_NOTIFICA_INICIO_PROCE", type="integer", nullable=false)
     */
    private $ftNotificaInicioProce;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '7';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HORA_CITACION", type="date", nullable=false)
     */
    private $horaCitacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_CITACION", type="string", length=255, nullable=false)
     */
    private $lugarCitacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_GESTION_CITACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_GESTION_CITACION_IDFT_GESTI", allocationSize=1, initialValue=1)
     */
    private $idftGestionCitacion;

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
     * @ORM\Column(name="CITACION", type="string", length=255, nullable=false)
     */
    private $citacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CITACION", type="date", nullable=false)
     */
    private $fechaCitacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_CITACION", type="string", length=255, nullable=false)
     */
    private $ciudadCitacion;

    /**
     * @var string
     *
     * @ORM\Column(name="CIUDAD_DILIGENCIA", type="string", length=255, nullable=false)
     */
    private $ciudadDiligencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_VERIFICACION_INFO", type="integer", nullable=true)
     */
    private $ftVerificacionInfo;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

