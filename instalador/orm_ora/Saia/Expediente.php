<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expediente
 *
 * @ORM\Table(name="EXPEDIENTE")
 * @ORM\Entity
 */
class Expediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDEXPEDIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="EXPEDIENTE_IDEXPEDIENTE_seq", allocationSize=1, initialValue=1)
     */
    private $idexpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="DESCRIPCION", type="text", nullable=true)
     */
    private $descripcion = 'empty_clob()';

    /**
     * @var string
     *
     * @ORM\Column(name="CODIGO", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="COD_PADRE", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="PROPIETARIO", type="string", length=255, nullable=true)
     */
    private $propietario;

    /**
     * @var string
     *
     * @ORM\Column(name="VER_TODOS", type="string", length=255, nullable=true)
     */
    private $verTodos;

    /**
     * @var string
     *
     * @ORM\Column(name="EDITAR_TODOS", type="string", length=255, nullable=true)
     */
    private $editarTodos;

    /**
     * @var integer
     *
     * @ORM\Column(name="FK_IDCAJA", type="integer", nullable=true)
     */
    private $fkIdcaja = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="SERIE_IDSERIE", type="string", length=255, nullable=true)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="COD_ARBOL", type="string", length=255, nullable=true)
     */
    private $codArbol;

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
     * @var string
     *
     * @ORM\Column(name="PROCESO", type="string", length=255, nullable=true)
     */
    private $proceso;

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
     * @var string
     *
     * @ORM\Column(name="UNIDAD_ADMIN", type="string", length=255, nullable=true)
     */
    private $unidadAdmin;

    /**
     * @var string
     *
     * @ORM\Column(name="RUTA_QR", type="string", length=255, nullable=true)
     */
    private $rutaQr;


}

