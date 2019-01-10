<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtHallazgo
 *
 * @ORM\Table(name="ft_hallazgo")
 * @ORM\Entity
 */
class FtHallazgo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_hallazgo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftHallazgo;

    /**
     * @var string
     *
     * @ORM\Column(name="accion_mejoramiento", type="text", length=65535, nullable=true)
     */
    private $accionMejoramiento;

    /**
     * @var string
     *
     * @ORM\Column(name="causas", type="text", length=65535, nullable=true)
     */
    private $causas;

    /**
     * @var integer
     *
     * @ORM\Column(name="clase_accion", type="integer", nullable=false)
     */
    private $claseAccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="clase_observacion", type="integer", nullable=false)
     */
    private $claseObservacion = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="consecutivo_hallazgo", type="string", length=255, nullable=true)
     */
    private $consecutivoHallazgo;

    /**
     * @var string
     *
     * @ORM\Column(name="correcion_hallazgo", type="text", length=65535, nullable=true)
     */
    private $correcionHallazgo;

    /**
     * @var string
     *
     * @ORM\Column(name="deficiencia", type="text", length=65535, nullable=false)
     */
    private $deficiencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

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
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_gestion_calid", type="integer", nullable=true)
     */
    private $ftGestionCalid;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_plan_mejoramiento", type="integer", nullable=false)
     */
    private $ftPlanMejoramiento;

    /**
     * @var string
     *
     * @ORM\Column(name="indicador_cumplimiento", type="text", length=65535, nullable=false)
     */
    private $indicadorCumplimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="mecanismo_interno", type="text", length=65535, nullable=false)
     */
    private $mecanismoInterno;

    /**
     * @var integer
     *
     * @ORM\Column(name="notifica_cump", type="integer", nullable=true)
     */
    private $notificaCump;

    /**
     * @var integer
     *
     * @ORM\Column(name="notifica_seg", type="integer", nullable=true)
     */
    private $notificaSeg;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="procesos_vinculados", type="string", length=255, nullable=false)
     */
    private $procesosVinculados;

    /**
     * @var string
     *
     * @ORM\Column(name="radicado_plan", type="string", length=20, nullable=true)
     */
    private $radicadoPlan;

    /**
     * @var string
     *
     * @ORM\Column(name="responsables", type="string", length=255, nullable=false)
     */
    private $responsables;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable_seguimiento", type="string", length=255, nullable=false)
     */
    private $responsableSeguimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="secretarias", type="string", length=255, nullable=true)
     */
    private $secretarias;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1055';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_cumplimiento", type="date", nullable=true)
     */
    private $tiempoCumplimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_seguimiento", type="date", nullable=false)
     */
    private $tiempoSeguimiento;


}
