<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtEstructuArmadaRepor
 *
 * @ORM\Table(name="FT_ESTRUCTU_ARMADA_REPOR")
 * @ORM\Entity
 */
class FtEstructuArmadaRepor
{
    /**
     * @var string
     *
     * @ORM\Column(name="ESTRUCTURA_ARMADA", type="string", length=255, nullable=true)
     */
    private $estructuraArmada;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSICION_CONFIANZA", type="integer", nullable=false)
     */
    private $posicionConfianza;

    /**
     * @var integer
     *
     * @ORM\Column(name="FT_REPORTE_ENTREVISTA", type="integer", nullable=true)
     */
    private $ftReporteEntrevista;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSICION_MANDO", type="integer", nullable=false)
     */
    private $posicionMando;

    /**
     * @var integer
     *
     * @ORM\Column(name="ROL_MILITAR", type="integer", nullable=false)
     */
    private $rolMilitar;

    /**
     * @var integer
     *
     * @ORM\Column(name="ROL_POLITICO", type="integer", nullable=false)
     */
    private $rolPolitico;

    /**
     * @var integer
     *
     * @ORM\Column(name="ROL_FINANCIERO", type="integer", nullable=false)
     */
    private $rolFinanciero;

    /**
     * @var integer
     *
     * @ORM\Column(name="ROL_LOGISTICO", type="integer", nullable=false)
     */
    private $rolLogistico;

    /**
     * @var integer
     *
     * @ORM\Column(name="PRESENCIA_LUGAR_HITO", type="integer", nullable=false)
     */
    private $presenciaLugarHito;

    /**
     * @var string
     *
     * @ORM\Column(name="ANIO_INGRESO_ESTRUCTU", type="string", length=255, nullable=true)
     */
    private $anioIngresoEstructu;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_RETIRO_ESTRUCTU", type="string", length=255, nullable=true)
     */
    private $fechaRetiroEstructu;

    /**
     * @var integer
     *
     * @ORM\Column(name="PERSONA_VINCULADA_GAI", type="integer", nullable=false)
     */
    private $personaVinculadaGai;

    /**
     * @var string
     *
     * @ORM\Column(name="LUGAR_DESMOVILIZACION", type="string", length=255, nullable=true)
     */
    private $lugarDesmovilizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="FECHA_DESMOVILIZACION", type="string", length=255, nullable=true)
     */
    private $fechaDesmovilizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="OBSERVACIONES", type="text", nullable=true)
     */
    private $observaciones = 'EMPTY_CLOB()';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDFT_ESTRUCTU_ARMADA_REPOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FT_ESTRUCTU_ARMADA_REPOR_IDFT_", allocationSize=1, initialValue=1)
     */
    private $idftEstructuArmadaRepor;


}

