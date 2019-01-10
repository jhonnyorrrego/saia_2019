<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPlanMejoramiento
 *
 * @ORM\Table(name="ft_plan_mejoramiento")
 * @ORM\Entity
 */
class FtPlanMejoramiento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_plan_mejoramiento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPlanMejoramiento;

    /**
     * @var string
     *
     * @ORM\Column(name="adjuntos", type="string", length=255, nullable=true)
     */
    private $adjuntos;

    /**
     * @var string
     *
     * @ORM\Column(name="aprobado", type="string", length=255, nullable=false)
     */
    private $aprobado;

    /**
     * @var string
     *
     * @ORM\Column(name="auditor", type="string", length=255, nullable=false)
     */
    private $auditor;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_otros", type="text", length=65535, nullable=true)
     */
    private $descripcionOtros;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_plan", type="text", length=65535, nullable=true)
     */
    private $descripcionPlan;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="elaborado", type="string", length=255, nullable=false)
     */
    private $elaborado;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=50, nullable=false)
     */
    private $estado = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_plan_mejoramiento", type="string", length=255, nullable=true)
     */
    private $estadoPlanMejoramiento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_terminado", type="string", length=5, nullable=true)
     */
    private $estadoTerminado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobado", type="datetime", nullable=true)
     */
    private $fechaAprobado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_elaborado", type="datetime", nullable=true)
     */
    private $fechaElaborado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_informe", type="date", nullable=false)
     */
    private $fechaInforme;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_revisado", type="datetime", nullable=true)
     */
    private $fechaRevisado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_suscripcion", type="date", nullable=false)
     */
    private $fechaSuscripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=true)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text", length=65535, nullable=false)
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivos_especificos", type="text", length=65535, nullable=true)
     */
    private $objetivosEspecificos;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="periodo_evaluado", type="string", length=255, nullable=false)
     */
    private $periodoEvaluado;

    /**
     * @var string
     *
     * @ORM\Column(name="revisado", type="string", length=255, nullable=false)
     */
    private $revisado;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '102';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_auditoria", type="string", length=255, nullable=false)
     */
    private $tipoAuditoria = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_plan", type="string", length=10, nullable=false)
     */
    private $tipoPlan;

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=false)
     */
    private $version = '2';


}
