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
    private $fecha = 'CURRENT_TIMESTAMP';

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
     * @ORM\Column(name="ruta_qr", type="string", length=255, nullable=true)
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
     * @ORM\Column(name="indice_uno", type="string", length=255, nullable=true)
     */
    private $indiceUno;

    /**
     * @var string
     *
     * @ORM\Column(name="indice_dos", type="string", length=255, nullable=true)
     */
    private $indiceDos;

    /**
     * @var string
     *
     * @ORM\Column(name="indice_tres", type="string", length=255, nullable=true)
     */
    private $indiceTres;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia_iddependencia", type="integer", nullable=false)
     */
    private $dependenciaIddependencia;



    /**
     * Get idexpediente
     *
     * @return integer
     */
    public function getIdexpediente()
    {
        return $this->idexpediente;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Expediente
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return Expediente
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Expediente
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Expediente
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return Expediente
     */
    public function setCodPadre($codPadre)
    {
        $this->codPadre = $codPadre;

        return $this;
    }

    /**
     * Get codPadre
     *
     * @return integer
     */
    public function getCodPadre()
    {
        return $this->codPadre;
    }

    /**
     * Set fkIdcaja
     *
     * @param integer $fkIdcaja
     *
     * @return Expediente
     */
    public function setFkIdcaja($fkIdcaja)
    {
        $this->fkIdcaja = $fkIdcaja;

        return $this;
    }

    /**
     * Get fkIdcaja
     *
     * @return integer
     */
    public function getFkIdcaja()
    {
        return $this->fkIdcaja;
    }

    /**
     * Set propietario
     *
     * @param string $propietario
     *
     * @return Expediente
     */
    public function setPropietario($propietario)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return string
     */
    public function getPropietario()
    {
        return $this->propietario;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return Expediente
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set codArbol
     *
     * @param string $codArbol
     *
     * @return Expediente
     */
    public function setCodArbol($codArbol)
    {
        $this->codArbol = $codArbol;

        return $this;
    }

    /**
     * Get codArbol
     *
     * @return string
     */
    public function getCodArbol()
    {
        return $this->codArbol;
    }

    /**
     * Set codigoNumero
     *
     * @param string $codigoNumero
     *
     * @return Expediente
     */
    public function setCodigoNumero($codigoNumero)
    {
        $this->codigoNumero = $codigoNumero;

        return $this;
    }

    /**
     * Get codigoNumero
     *
     * @return string
     */
    public function getCodigoNumero()
    {
        return $this->codigoNumero;
    }

    /**
     * Set fondo
     *
     * @param string $fondo
     *
     * @return Expediente
     */
    public function setFondo($fondo)
    {
        $this->fondo = $fondo;

        return $this;
    }

    /**
     * Get fondo
     *
     * @return string
     */
    public function getFondo()
    {
        return $this->fondo;
    }

    /**
     * Set proceso
     *
     * @param string $proceso
     *
     * @return Expediente
     */
    public function setProceso($proceso)
    {
        $this->proceso = $proceso;

        return $this;
    }

    /**
     * Get proceso
     *
     * @return string
     */
    public function getProceso()
    {
        return $this->proceso;
    }

    /**
     * Set fechaExtremaI
     *
     * @param \DateTime $fechaExtremaI
     *
     * @return Expediente
     */
    public function setFechaExtremaI($fechaExtremaI)
    {
        $this->fechaExtremaI = $fechaExtremaI;

        return $this;
    }

    /**
     * Get fechaExtremaI
     *
     * @return \DateTime
     */
    public function getFechaExtremaI()
    {
        return $this->fechaExtremaI;
    }

    /**
     * Set fechaExtremaF
     *
     * @param \DateTime $fechaExtremaF
     *
     * @return Expediente
     */
    public function setFechaExtremaF($fechaExtremaF)
    {
        $this->fechaExtremaF = $fechaExtremaF;

        return $this;
    }

    /**
     * Get fechaExtremaF
     *
     * @return \DateTime
     */
    public function getFechaExtremaF()
    {
        return $this->fechaExtremaF;
    }

    /**
     * Set noUnidadConservacion
     *
     * @param string $noUnidadConservacion
     *
     * @return Expediente
     */
    public function setNoUnidadConservacion($noUnidadConservacion)
    {
        $this->noUnidadConservacion = $noUnidadConservacion;

        return $this;
    }

    /**
     * Get noUnidadConservacion
     *
     * @return string
     */
    public function getNoUnidadConservacion()
    {
        return $this->noUnidadConservacion;
    }

    /**
     * Set noFolios
     *
     * @param string $noFolios
     *
     * @return Expediente
     */
    public function setNoFolios($noFolios)
    {
        $this->noFolios = $noFolios;

        return $this;
    }

    /**
     * Get noFolios
     *
     * @return string
     */
    public function getNoFolios()
    {
        return $this->noFolios;
    }

    /**
     * Set noCarpeta
     *
     * @param string $noCarpeta
     *
     * @return Expediente
     */
    public function setNoCarpeta($noCarpeta)
    {
        $this->noCarpeta = $noCarpeta;

        return $this;
    }

    /**
     * Get noCarpeta
     *
     * @return string
     */
    public function getNoCarpeta()
    {
        return $this->noCarpeta;
    }

    /**
     * Set soporte
     *
     * @param integer $soporte
     *
     * @return Expediente
     */
    public function setSoporte($soporte)
    {
        $this->soporte = $soporte;

        return $this;
    }

    /**
     * Get soporte
     *
     * @return integer
     */
    public function getSoporte()
    {
        return $this->soporte;
    }

    /**
     * Set frecuenciaConsulta
     *
     * @param integer $frecuenciaConsulta
     *
     * @return Expediente
     */
    public function setFrecuenciaConsulta($frecuenciaConsulta)
    {
        $this->frecuenciaConsulta = $frecuenciaConsulta;

        return $this;
    }

    /**
     * Get frecuenciaConsulta
     *
     * @return integer
     */
    public function getFrecuenciaConsulta()
    {
        return $this->frecuenciaConsulta;
    }

    /**
     * Set ubicacion
     *
     * @param integer $ubicacion
     *
     * @return Expediente
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return integer
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set unidadAdmin
     *
     * @param string $unidadAdmin
     *
     * @return Expediente
     */
    public function setUnidadAdmin($unidadAdmin)
    {
        $this->unidadAdmin = $unidadAdmin;

        return $this;
    }

    /**
     * Get unidadAdmin
     *
     * @return string
     */
    public function getUnidadAdmin()
    {
        return $this->unidadAdmin;
    }

    /**
     * Set rutaQr
     *
     * @param string $rutaQr
     *
     * @return Expediente
     */
    public function setRutaQr($rutaQr)
    {
        $this->rutaQr = $rutaQr;

        return $this;
    }

    /**
     * Get rutaQr
     *
     * @return string
     */
    public function getRutaQr()
    {
        return $this->rutaQr;
    }

    /**
     * Set estadoArchivo
     *
     * @param integer $estadoArchivo
     *
     * @return Expediente
     */
    public function setEstadoArchivo($estadoArchivo)
    {
        $this->estadoArchivo = $estadoArchivo;

        return $this;
    }

    /**
     * Get estadoArchivo
     *
     * @return integer
     */
    public function getEstadoArchivo()
    {
        return $this->estadoArchivo;
    }

    /**
     * Set estadoCierre
     *
     * @param integer $estadoCierre
     *
     * @return Expediente
     */
    public function setEstadoCierre($estadoCierre)
    {
        $this->estadoCierre = $estadoCierre;

        return $this;
    }

    /**
     * Get estadoCierre
     *
     * @return integer
     */
    public function getEstadoCierre()
    {
        return $this->estadoCierre;
    }

    /**
     * Set fechaCierre
     *
     * @param \DateTime $fechaCierre
     *
     * @return Expediente
     */
    public function setFechaCierre($fechaCierre)
    {
        $this->fechaCierre = $fechaCierre;

        return $this;
    }

    /**
     * Get fechaCierre
     *
     * @return \DateTime
     */
    public function getFechaCierre()
    {
        return $this->fechaCierre;
    }

    /**
     * Set funcionarioCierre
     *
     * @param integer $funcionarioCierre
     *
     * @return Expediente
     */
    public function setFuncionarioCierre($funcionarioCierre)
    {
        $this->funcionarioCierre = $funcionarioCierre;

        return $this;
    }

    /**
     * Get funcionarioCierre
     *
     * @return integer
     */
    public function getFuncionarioCierre()
    {
        return $this->funcionarioCierre;
    }

    /**
     * Set proxEstadoArchivo
     *
     * @param integer $proxEstadoArchivo
     *
     * @return Expediente
     */
    public function setProxEstadoArchivo($proxEstadoArchivo)
    {
        $this->proxEstadoArchivo = $proxEstadoArchivo;

        return $this;
    }

    /**
     * Get proxEstadoArchivo
     *
     * @return integer
     */
    public function getProxEstadoArchivo()
    {
        return $this->proxEstadoArchivo;
    }

    /**
     * Set notasTransf
     *
     * @param string $notasTransf
     *
     * @return Expediente
     */
    public function setNotasTransf($notasTransf)
    {
        $this->notasTransf = $notasTransf;

        return $this;
    }

    /**
     * Get notasTransf
     *
     * @return string
     */
    public function getNotasTransf()
    {
        return $this->notasTransf;
    }

    /**
     * Set tomoPadre
     *
     * @param integer $tomoPadre
     *
     * @return Expediente
     */
    public function setTomoPadre($tomoPadre)
    {
        $this->tomoPadre = $tomoPadre;

        return $this;
    }

    /**
     * Get tomoPadre
     *
     * @return integer
     */
    public function getTomoPadre()
    {
        return $this->tomoPadre;
    }

    /**
     * Set tomoNo
     *
     * @param integer $tomoNo
     *
     * @return Expediente
     */
    public function setTomoNo($tomoNo)
    {
        $this->tomoNo = $tomoNo;

        return $this;
    }

    /**
     * Get tomoNo
     *
     * @return integer
     */
    public function getTomoNo()
    {
        return $this->tomoNo;
    }

    /**
     * Set agrupador
     *
     * @param integer $agrupador
     *
     * @return Expediente
     */
    public function setAgrupador($agrupador)
    {
        $this->agrupador = $agrupador;

        return $this;
    }

    /**
     * Get agrupador
     *
     * @return integer
     */
    public function getAgrupador()
    {
        return $this->agrupador;
    }

    /**
     * Set indiceUno
     *
     * @param string $indiceUno
     *
     * @return Expediente
     */
    public function setIndiceUno($indiceUno)
    {
        $this->indiceUno = $indiceUno;

        return $this;
    }

    /**
     * Get indiceUno
     *
     * @return string
     */
    public function getIndiceUno()
    {
        return $this->indiceUno;
    }

    /**
     * Set indiceDos
     *
     * @param string $indiceDos
     *
     * @return Expediente
     */
    public function setIndiceDos($indiceDos)
    {
        $this->indiceDos = $indiceDos;

        return $this;
    }

    /**
     * Get indiceDos
     *
     * @return string
     */
    public function getIndiceDos()
    {
        return $this->indiceDos;
    }

    /**
     * Set indiceTres
     *
     * @param string $indiceTres
     *
     * @return Expediente
     */
    public function setIndiceTres($indiceTres)
    {
        $this->indiceTres = $indiceTres;

        return $this;
    }

    /**
     * Get indiceTres
     *
     * @return string
     */
    public function getIndiceTres()
    {
        return $this->indiceTres;
    }

    /**
     * Set dependenciaIddependencia
     *
     * @param integer $dependenciaIddependencia
     *
     * @return Expediente
     */
    public function setDependenciaIddependencia($dependenciaIddependencia)
    {
        $this->dependenciaIddependencia = $dependenciaIddependencia;

        return $this;
    }

    /**
     * Get dependenciaIddependencia
     *
     * @return integer
     */
    public function getDependenciaIddependencia()
    {
        return $this->dependenciaIddependencia;
    }
}
