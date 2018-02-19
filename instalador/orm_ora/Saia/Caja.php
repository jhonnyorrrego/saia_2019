<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caja
 *
 * @ORM\Table(name="CAJA")
 * @ORM\Entity
 */
class Caja
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCAJA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CAJA_IDCAJA_seq", allocationSize=1, initialValue=1)
     */
    private $idcaja;

    /**
     * @var string
     *
     * @ORM\Column(name="FONDO", type="string", length=255, nullable=true)
     */
    private $fondo;

    /**
     * @var string
     *
     * @ORM\Column(name="SECCION", type="string", length=255, nullable=true)
     */
    private $seccion;

    /**
     * @var string
     *
     * @ORM\Column(name="SUBSECCION", type="string", length=255, nullable=true)
     */
    private $subseccion;

    /**
     * @var string
     *
     * @ORM\Column(name="DIVISION", type="string", length=255, nullable=true)
     */
    private $division;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CARPETAS", type="string", length=255, nullable=true)
     */
    private $noCarpetas;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CAJAS", type="string", length=255, nullable=true)
     */
    private $noCajas;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CONSECUTIVO", type="string", length=255, nullable=true)
     */
    private $noConsecutivo;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CORRELATIVO", type="string", length=255, nullable=true)
     */
    private $noCorrelativo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_EXTREMA_I", type="date", nullable=true)
     */
    private $fechaExtremaI;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_EXTREMA_F", type="date", nullable=true)
     */
    private $fechaExtremaF;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTANTERIA", type="string", length=255, nullable=true)
     */
    private $estanteria;

    /**
     * @var integer
     *
     * @ORM\Column(name="PANEL", type="integer", nullable=true)
     */
    private $panel;

    /**
     * @var string
     *
     * @ORM\Column(name="MATERIAL", type="string", length=255, nullable=true)
     */
    private $material;

    /**
     * @var string
     *
     * @ORM\Column(name="SEGURIDAD", type="string", length=255, nullable=true)
     */
    private $seguridad;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_QR", type="string", length=255, nullable=true)
     */
    private $rutaQr;


}
