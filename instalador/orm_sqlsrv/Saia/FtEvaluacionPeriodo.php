<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEvaluacionPeriodo
 *
 * @ORM\Table(name="ft_evaluacion_periodo")
 * @ORM\Entity
 */
class FtEvaluacionPeriodo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_evaluacion_periodo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftEvaluacionPeriodo;

    /**
     * @var string
     *
     * @ORM\Column(name="accion_mejora", type="text", length=65535, nullable=false)
     */
    private $accionMejora;

    /**
     * @var string
     *
     * @ORM\Column(name="aspectos_mejorar", type="text", length=65535, nullable=false)
     */
    private $aspectosMejorar;

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
     * @var string
     *
     * @ORM\Column(name="evalua_induccion", type="text", length=65535, nullable=false)
     */
    private $evaluaInduccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_evaluacion", type="date", nullable=false)
     */
    private $fechaEvaluacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="fortalezas", type="text", length=65535, nullable=false)
     */
    private $fortalezas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="identificacion_emp", type="integer", nullable=false)
     */
    private $identificacionEmp;

    /**
     * @var integer
     *
     * @ORM\Column(name="integridad", type="integer", nullable=false)
     */
    private $integridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="oportunidad_trabajo", type="integer", nullable=false)
     */
    private $oportunidadTrabajo;

    /**
     * @var integer
     *
     * @ORM\Column(name="orientacion_clie", type="integer", nullable=false)
     */
    private $orientacionClie;

    /**
     * @var string
     *
     * @ORM\Column(name="proceso_adaptacion", type="text", length=65535, nullable=false)
     */
    private $procesoAdaptacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="relaciones_inter", type="integer", nullable=false)
     */
    private $relacionesInter;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1089';

    /**
     * @var integer
     *
     * @ORM\Column(name="tolerancia_tension", type="integer", nullable=false)
     */
    private $toleranciaTension;

    /**
     * @var integer
     *
     * @ORM\Column(name="trabajo_equipo", type="integer", nullable=false)
     */
    private $trabajoEquipo;


}

