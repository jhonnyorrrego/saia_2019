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
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfolder;

    /**
     * @var integer
     *
     * @ORM\Column(name="caja_idcaja", type="integer", nullable=false)
     */
    private $cajaIdcaja = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="unidad_admin", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="numero_orden", type="string", length=255, nullable=false)
     */
    private $numeroOrden;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_expediente", type="text", length=65535, nullable=false)
     */
    private $nombreExpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="no_tomo", type="string", length=255, nullable=false)
     */
    private $noTomo;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_numero", type="string", length=255, nullable=false)
     */
    private $codigoNumero;

    /**
     * @var string
     *
     * @ORM\Column(name="fondo", type="string", length=255, nullable=false)
     */
    private $fondo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_extrema_i", type="datetime", nullable=false)
     */
    private $fechaExtremaI;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_extrema_f", type="datetime", nullable=false)
     */
    private $fechaExtremaF;

    /**
     * @var string
     *
     * @ORM\Column(name="no_unidad_conservacion", type="string", length=255, nullable=false)
     */
    private $noUnidadConservacion;

    /**
     * @var string
     *
     * @ORM\Column(name="no_folios", type="string", length=255, nullable=false)
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
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;


}

