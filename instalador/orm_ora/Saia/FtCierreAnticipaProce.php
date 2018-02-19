<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtCierreAnticipaProce
 *
 * @ORM\Table(name="FT_CIERRE_ANTICIPA_PROCE", indexes={@ORM\Index(name="i_cierre_antic", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class FtCierreAnticipaProce
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_ASIGNA_ABOGADO", type="integer", nullable=false)
     */
    private $ftAsignaAbogado;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '721';

    /**
     * @var integer
     *
     * @ORM\Column(name="ACCION_CIERRE_PROCESO", type="integer", nullable=false)
     */
    private $accionCierreProceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CIERRE_ANTICIPA_PROCE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CIERRE_ANTICIPA_PROCE_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftCierreAnticipaProce;

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
     * @ORM\Column(name="FECHA_RADICA_CIERRE", type="date", nullable=false)
     */
    private $fechaRadicaCierre = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="CONSECUTIVO_RECEPCION", type="string", length=255, nullable=false)
     */
    private $consecutivoRecepcion;

    /**
     * @var string
     *
     * @ORM\Column(name="MOTIVO_ATIPICO_PROCE", type="text", nullable=false)
     */
    private $motivoAtipicoProce = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACION_CIERRE", type="text", nullable=true)
     */
    private $observacionCierre = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="SOPORTE_CIERRE_PROCE", type="string", length=255, nullable=true)
     */
    private $soporteCierreProce;


}

