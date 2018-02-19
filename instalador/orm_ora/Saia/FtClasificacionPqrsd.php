<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtClasificacionPqrsd
 *
 * @ORM\Table(name="FT_CLASIFICACION_PQRSD", indexes={@ORM\Index(name="ft_clasificacion_pqrsd_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtClasificacionPqrsd
{
    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_PQRSD", type="string", length=255, nullable=false)
     */
    private $tipoPqrsd;

    /**
     * @var string
     *
     * @ORM\Column(name="DEP_RESPONSABLE", type="string", length=255, nullable=false)
     */
    private $depResponsable;

    /**
     * @var string
     *
     * @ORM\Column(name="ANEX_PQRSD", type="string", length=255, nullable=true)
     */
    private $anexPqrsd;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CLASIFICACION_PQRSD", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CLASIFICACION_PQRSD_IDFT_CL", allocationSize=1, initialValue=1)
     */
    private $idftClasificacionPqrsd;

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
    private $serieIdserie = '462';

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_REGISTRO_PQRS", type="integer", nullable=false)
     */
    private $ftRegistroPqrs;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_CONCEPTO_COORDINADOR", type="integer", nullable=true)
     */
    private $ftConceptoCoordinador;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_CLASI", type="text", nullable=true)
     */
    private $observacionesClasi = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="CON_COPIA", type="string", length=255, nullable=true)
     */
    private $conCopia;

    /**
     * @var integer
     *
     * @ORM\Column(name="FECHA_LIMITE_RES", type="integer", nullable=true)
     */
    private $fechaLimiteRes;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RES", type="date", nullable=true)
     */
    private $fechaRes = 'SYSDATE';


}

