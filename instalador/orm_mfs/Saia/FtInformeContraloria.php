<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtInformeContraloria
 *
 * @ORM\Table(name="ft_informe_contraloria")
 * @ORM\Entity
 */
class FtInformeContraloria
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_informe_contraloria", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftInformeContraloria;

    /**
     * @var string
     *
     * @ORM\Column(name="conclusiones", type="text", length=65535, nullable=true)
     */
    private $conclusiones;

    /**
     * @var string
     *
     * @ORM\Column(name="cumplimiento_especificos", type="text", length=65535, nullable=true)
     */
    private $cumplimientoEspecificos;

    /**
     * @var string
     *
     * @ORM\Column(name="cumplimiento_general", type="text", length=65535, nullable=true)
     */
    private $cumplimientoGeneral;

    /**
     * @var string
     *
     * @ORM\Column(name="cumplimiento_plan", type="string", length=255, nullable=false)
     */
    private $cumplimientoPlan;

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
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_compromisos", type="date", nullable=false)
     */
    private $fechaCompromisos;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_plan_mejoramiento", type="integer", nullable=false)
     */
    private $ftPlanMejoramiento;

    /**
     * @var string
     *
     * @ORM\Column(name="jefe_control", type="string", length=255, nullable=false)
     */
    private $jefeControl;

    /**
     * @var string
     *
     * @ORM\Column(name="municipio_informe", type="string", length=255, nullable=true)
     */
    private $municipioInforme;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="proceso_auditado", type="text", length=65535, nullable=true)
     */
    private $procesoAuditado;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '2580';


}

