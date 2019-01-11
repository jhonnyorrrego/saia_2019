<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caja
 *
 * @ORM\Table(name="caja")
 * @ORM\Entity
 */
class Caja
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcaja", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcaja;

    /**
     * @var string
     *
     * @ORM\Column(name="fondo", type="string", length=255, nullable=true)
     */
    private $fondo;

    /**
     * @var string
     *
     * @ORM\Column(name="seccion", type="string", length=255, nullable=true)
     */
    private $seccion;

    /**
     * @var string
     *
     * @ORM\Column(name="subseccion", type="string", length=255, nullable=true)
     */
    private $subseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="division", type="string", length=255, nullable=true)
     */
    private $division;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia_iddependencia", type="integer", nullable=false)
     */
    private $dependenciaIddependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="no_carpetas", type="string", length=255, nullable=true)
     */
    private $noCarpetas;

    /**
     * @var string
     *
     * @ORM\Column(name="no_cajas", type="string", length=255, nullable=true)
     */
    private $noCajas;

    /**
     * @var string
     *
     * @ORM\Column(name="no_consecutivo", type="string", length=255, nullable=true)
     */
    private $noConsecutivo;

    /**
     * @var string
     *
     * @ORM\Column(name="no_correlativo", type="string", length=255, nullable=true)
     */
    private $noCorrelativo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_extrema_i", type="date", nullable=true)
     */
    private $fechaExtremaI;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_extrema_f", type="date", nullable=true)
     */
    private $fechaExtremaF;

    /**
     * @var string
     *
     * @ORM\Column(name="estanteria", type="string", length=255, nullable=true)
     */
    private $estanteria = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="panel", type="integer", nullable=true)
     */
    private $panel = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="material", type="string", length=255, nullable=true)
     */
    private $material = '';

    /**
     * @var string
     *
     * @ORM\Column(name="seguridad", type="string", length=255, nullable=true)
     */
    private $seguridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_qr", type="string", length=600, nullable=true)
     */
    private $rutaQr;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_archivo", type="integer", nullable=true)
     */
    private $estadoArchivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="modulo", type="string", length=255, nullable=false)
     */
    private $modulo;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel", type="string", length=255, nullable=false)
     */
    private $nivel;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_serie", type="string", length=255, nullable=true)
     */
    private $codigoSerie;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_dependencia", type="string", length=255, nullable=true)
     */
    private $codigoDependencia;


}

