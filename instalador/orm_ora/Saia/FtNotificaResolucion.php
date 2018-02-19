<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtNotificaResolucion
 *
 * @ORM\Table(name="FT_NOTIFICA_RESOLUCION", indexes={@ORM\Index(name="ft_notifica_resolucion_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_notifica_res", columns={"DEPENDENCIA"}), @ORM\Index(name="i_ft_certifica_contribucion", columns={"FT_CERTIFICA_CONTRIBUCION"})})
 * @ORM\Entity
 */
class FtNotificaResolucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CERTIFICA_CONTRIBUCION", type="integer", nullable=false)
     */
    private $ftCertificaContribucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '326';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ACTA", type="date", nullable=false)
     */
    private $fechaActa = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_ACTA", type="string", length=255, nullable=false)
     */
    private $numeroActa;

    /**
     * @var string
     *
     * @ORM\Column(name="ADJUNTAR_ACTA", type="string", length=255, nullable=true)
     */
    private $adjuntarActa;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_NOTIFICA_RESOLUCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_NOTIFICA_RESOLUCION_IDFT_NO", allocationSize=1, initialValue=1)
     */
    private $idftNotificaResolucion;

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
     * @ORM\Column(name="FECHA_PRIMER_NOTI", type="date", nullable=true)
     */
    private $fechaPrimerNoti = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="FIRMANTE_PRESENTO", type="integer", nullable=true)
     */
    private $firmantePresento;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

