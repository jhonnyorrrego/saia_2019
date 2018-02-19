<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCertificaContribucion
 *
 * @ORM\Table(name="FT_CERTIFICA_CONTRIBUCION")
 * @ORM\Entity
 */
class FtCertificaContribucion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="CONCEPTO_COORDINADOR", type="integer", nullable=true)
     */
    private $conceptoCoordinador;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '325';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_CERTIFICACION", type="date", nullable=false)
     */
    private $fechaCertificacion = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="OTROS_CONSIDERANDOS", type="text", nullable=true)
     */
    private $otrosConsiderandos;

    /**
     * @var string
     *
     * @ORM\Column(name="OTROS_RESUELVE", type="text", nullable=true)
     */
    private $otrosResuelve;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CERTIFICA_CONTRIBUCION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CERTIFICA_CONTRIBUCION_IDFT", allocationSize=1, initialValue=1)
     */
    private $idftCertificaContribucion;

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
     * @ORM\Column(name="INICIALES_FUNCIONARIO", type="string", length=255, nullable=true)
     */
    private $inicialesFuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="INICIALES_REVISO", type="string", length=255, nullable=true)
     */
    private $inicialesReviso;

    /**
     * @var string
     *
     * @ORM\Column(name="INICIALES_APROBO", type="string", length=255, nullable=true)
     */
    private $inicialesAprobo;

    /**
     * @var string
     *
     * @ORM\Column(name="CERTIFICACION_FIRMADA", type="string", length=255, nullable=true)
     */
    private $certificacionFirmada;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_ADICIONAL", type="date", nullable=true)
     */
    private $fechaAdicional = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RESOLUCION", type="date", nullable=true)
     */
    private $fechaResolucion = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="NUMERO_RESOLUCION", type="integer", nullable=true)
     */
    private $numeroResolucion;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_RECEPCION_ACUERDOS", type="integer", nullable=true)
     */
    private $ftRecepcionAcuerdos;


}

