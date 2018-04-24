<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Expediente
 *
 * @ORM\Table(name="expediente", indexes={@ORM\Index(name="fk_idcaja", columns={"fk_idcaja"}), @ORM\Index(name="serie_idserie", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class Expediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idexpediente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idexpediente;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idcaja", type="integer", nullable=true)
     */
    private $fkIdcaja = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="propietario", type="string", length=255, nullable=false)
     */
    private $propietario;

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
     * @ORM\Column(name="cod_arbol", type="string", length=255, nullable=true)
     */
    private $codArbol;

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
     * @var string
     *
     * @ORM\Column(name="proceso", type="string", length=255, nullable=true)
     */
    private $proceso;

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
     * @var string
     *
     * @ORM\Column(name="unidad_admin", type="string", length=255, nullable=true)
     */
    private $unidadAdmin;

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
     * @var integer
     *
     * @ORM\Column(name="estado_cierre", type="integer", nullable=true)
     */
    private $estadoCierre = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cierre", type="date", nullable=true)
     */
    private $fechaCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_cierre", type="integer", nullable=true)
     */
    private $funcionarioCierre;

    /**
     * @var integer
     *
     * @ORM\Column(name="prox_estado_archivo", type="integer", nullable=true)
     */
    private $proxEstadoArchivo;

    /**
     * @var string
     *
     * @ORM\Column(name="notas_transf", type="text", length=65535, nullable=true)
     */
    private $notasTransf;

    /**
     * @var integer
     *
     * @ORM\Column(name="tomo_padre", type="integer", nullable=true)
     */
    private $tomoPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="tomo_no", type="integer", nullable=true)
     */
    private $tomoNo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="agrupador", type="integer", nullable=true)
     */
    private $agrupador = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="indice_uno", type="string", length=255, nullable=false)
     */
    private $indiceUno;

    /**
     * @var string
     *
     * @ORM\Column(name="indice_dos", type="string", length=255, nullable=false)
     */
    private $indiceDos;

    /**
     * @var string
     *
     * @ORM\Column(name="indice_tres", type="string", length=255, nullable=false)
     */
    private $indiceTres;

    /**
     * @var string
     *
     * @ORM\Column(name="ver_todos", type="string", length=255, nullable=false)
     */
    private $verTodos;

    /**
     * @var string
     *
     * @ORM\Column(name="editar_todos", type="string", length=255, nullable=false)
     */
    private $editarTodos;


}
