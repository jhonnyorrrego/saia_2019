<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Folder
 *
 * @ORM\Table(name="FOLDER", indexes={@ORM\Index(name="i_folder_descripcio_ctx", columns={"DESCRIPCION"}), @ORM\Index(name="i_folder_nombre_exp_ctx", columns={"NOMBRE_EXPEDIENTE"})})
 * @ORM\Entity
 */
class Folder
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFOLDER", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FOLDER_IDFOLDER_seq", allocationSize=1, initialValue=1)
     */
    private $idfolder;

    /**
     * @var integer
     *
     * @ORM\Column(name="CAJA_IDCAJA", type="integer", nullable=false)
     */
    private $cajaIdcaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="integer", nullable=false)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="TITULO", type="string", length=255, nullable=true)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="AUTOR", type="integer", nullable=false)
     */
    private $autor;

    /**
     * @var string
     *
     * @ORM\Column(name="SEGURIDAD", type="string", length=255, nullable=true)
     */
    private $seguridad;

    /**
     * @var string
     *
     * @ORM\Column(name="UNIDAD_ADMIN", type="string", length=255, nullable=true)
     */
    private $unidadAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="SUBSECCION_I", type="string", length=255, nullable=true)
     */
    private $subseccionI;

    /**
     * @var string
     *
     * @ORM\Column(name="SUBSECCION_II", type="string", length=255, nullable=true)
     */
    private $subseccionIi;

    /**
     * @var string
     *
     * @ORM\Column(name="NUMERO_ORDEN", type="string", length=255, nullable=true)
     */
    private $numeroOrden;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE_EXPEDIENTE", type="text", nullable=true)
     */
    private $nombreExpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_TOMO", type="string", length=255, nullable=true)
     */
    private $noTomo;

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO_NUMERO", type="string", length=255, nullable=true)
     */
    private $codigoNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="FONDO", type="string", length=255, nullable=true)
     */
    private $fondo;

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
     * @ORM\Column(name="NO_UNIDAD_CONSERVACION", type="string", length=255, nullable=true)
     */
    private $noUnidadConservacion;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_FOLIOS", type="string", length=255, nullable=true)
     */
    private $noFolios;

    /**
     * @var string
     *
     * @ORM\Column(name="NO_CARPETA", type="string", length=255, nullable=true)
     */
    private $noCarpeta;

    /**
     * @var integer
     *
     * @ORM\Column(name="SOPORTE", type="integer", nullable=true)
     */
    private $soporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="FRECUENCIA_CONSULTA", type="integer", nullable=true)
     */
    private $frecuenciaConsulta;

    /**
     * @var integer
     *
     * @ORM\Column(name="UBICACION", type="integer", nullable=true)
     */
    private $ubicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario;


}
