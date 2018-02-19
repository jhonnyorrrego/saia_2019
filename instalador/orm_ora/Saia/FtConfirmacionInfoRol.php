<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConfirmacionInfoRol
 *
 * @ORM\Table(name="FT_CONFIRMACION_INFO_ROL", indexes={@ORM\Index(name="ft_confirmacion_info_rol_doc", columns={"DOCUMENTO_IDDOCUMENTO"}), @ORM\Index(name="i_confirmacion", columns={"DEPENDENCIA"})})
 * @ORM\Entity
 */
class FtConfirmacionInfoRol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FT_VALORACION_ASIGNADO", type="integer", nullable=false)
     */
    private $ftValoracionAsignado;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie = '323';

    /**
     * @var integer
     *
     * @ORM\Column(name="INFORMACION_ROL", type="integer", nullable=false)
     */
    private $informacionRol;

    /**
     * @var integer
     *
     * @ORM\Column(name="NUEVAS_ESTRUCTURAS", type="integer", nullable=false)
     */
    private $nuevasEstructuras;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTRUCTURA_ARMADA", type="string", length=255, nullable=true)
     */
    private $estructuraArmada;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSICION_MANDO", type="integer", nullable=true)
     */
    private $posicionMando;

    /**
     * @var integer
     *
     * @ORM\Column(name="TUVO_ROL_MILITAR", type="integer", nullable=true)
     */
    private $tuvoRolMilitar;

    /**
     * @var integer
     *
     * @ORM\Column(name="TUVO_ROL_POLITICO", type="integer", nullable=true)
     */
    private $tuvoRolPolitico;

    /**
     * @var integer
     *
     * @ORM\Column(name="TUVO_ROL_FINANCIERO", type="integer", nullable=true)
     */
    private $tuvoRolFinanciero;

    /**
     * @var integer
     *
     * @ORM\Column(name="TUVO_ROL_LOGISTICO", type="integer", nullable=true)
     */
    private $tuvoRolLogistico;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSICION_CONFIANZA", type="integer", nullable=true)
     */
    private $posicionConfianza;

    /**
     * @var integer
     *
     * @ORM\Column(name="LUGARES_VIOLENCIA", type="integer", nullable=true)
     */
    private $lugaresViolencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ANIO_INGRESO_ESTRUCTU", type="date", nullable=true)
     */
    private $anioIngresoEstructu = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_RETIRO_ESTRUCTU", type="date", nullable=true)
     */
    private $fechaRetiroEstructu = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERSONA_DESMOVILI_GAI", type="integer", nullable=true)
     */
    private $personaDesmoviliGai;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_CONFIRMACION_INFO_ROL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_CONFIRMACION_INFO_ROL_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftConfirmacionInfoRol;

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
     * @ORM\Column(name="OBSERVACIONES_INFO", type="text", nullable=true)
     */
    private $observacionesInfo = 'EMPTY_CLOB()';

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES_TREL", type="text", nullable=true)
     */
    private $observacionesTrel = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="DOC_PADRE_ACUERDO", type="integer", nullable=true)
     */
    private $docPadreAcuerdo;


}

