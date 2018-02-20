<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Folder
 *
 * @ORM\Table(name="folder")
 * @ORM\Entity
 */
class Folder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfolder", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idfolder;

    /**
     * @var integer
     *
     * @ORM\Column(name="caja_idcaja", type="integer", nullable=false)
     */
    private $cajaIdcaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="autor", type="integer", nullable=false)
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="seguridad", type="string", length=255, nullable=true)
     */
    private $seguridad;

    /**
     * @var string
     *
     * @ORM\Column(name="unidad_admin", type="string", length=255, nullable=true)
     */
    private $unidadAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="subseccion_i", type="string", length=255, nullable=true)
     */
    private $subseccionI;

    /**
     * @var string
     *
     * @ORM\Column(name="subseccion_ii", type="string", length=255, nullable=true)
     */
    private $subseccionIi;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_orden", type="string", length=255, nullable=true)
     */
    private $numeroOrden;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_expediente", type="text", nullable=true)
     */
    private $nombreExpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="no_tomo", type="string", length=255, nullable=true)
     */
    private $noTomo;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_numero", type="string", length=255, nullable=true)
     */
    private $codigoNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="fondo", type="string", length=255, nullable=true)
     */
    private $fondo;

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
     * @ORM\Column(name="no_unidad_conservacion", type="string", length=255, nullable=true)
     */
    private $noUnidadConservacion;

    /**
     * @var string
     *
     * @ORM\Column(name="no_folios", type="string", length=255, nullable=true)
     */
    private $noFolios;

    /**
     * @var string
     *
     * @ORM\Column(name="no_carpeta", type="string", length=255, nullable=true)
     */
    private $noCarpeta;

    /**
     * @var integer
     *
     * @ORM\Column(name="soporte", type="integer", nullable=true)
     */
    private $soporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="frecuencia_consulta", type="integer", nullable=true)
     */
    private $frecuenciaConsulta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ubicacion", type="integer", nullable=true)
     */
    private $ubicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;


}
