<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caja
 *
 * @ORM\Table(name="caja", indexes={@ORM\Index(name="i_caja_serie_idse", columns={"serie_idserie"})})
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
     * @var string
     *
     * @ORM\Column(name="modulo", type="string", length=255, nullable=true)
     */
    private $modulo;

    /**
     * @var string
     *
     * @ORM\Column(name="nivel", type="string", length=255, nullable=true)
     */
    private $nivel;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia_iddependencia", type="integer", nullable=false)
     */
    private $dependenciaIddependencia;



    /**
     * Get idcaja
     *
     * @return integer
     */
    public function getIdcaja()
    {
        return $this->idcaja;
    }

    /**
     * Set fondo
     *
     * @param string $fondo
     *
     * @return Caja
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
     * Set seccion
     *
     * @param string $seccion
     *
     * @return Caja
     */
    public function setSeccion($seccion)
    {
        $this->seccion = $seccion;

        return $this;
    }

    /**
     * Get seccion
     *
     * @return string
     */
    public function getSeccion()
    {
        return $this->seccion;
    }

    /**
     * Set subseccion
     *
     * @param string $subseccion
     *
     * @return Caja
     */
    public function setSubseccion($subseccion)
    {
        $this->subseccion = $subseccion;

        return $this;
    }

    /**
     * Get subseccion
     *
     * @return string
     */
    public function getSubseccion()
    {
        return $this->subseccion;
    }

    /**
     * Set division
     *
     * @param string $division
     *
     * @return Caja
     */
    public function setDivision($division)
    {
        $this->division = $division;

        return $this;
    }

    /**
     * Get division
     *
     * @return string
     */
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Caja
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return Caja
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
     * Set noCarpetas
     *
     * @param string $noCarpetas
     *
     * @return Caja
     */
    public function setNoCarpetas($noCarpetas)
    {
        $this->noCarpetas = $noCarpetas;

        return $this;
    }

    /**
     * Get noCarpetas
     *
     * @return string
     */
    public function getNoCarpetas()
    {
        return $this->noCarpetas;
    }

    /**
     * Set noCajas
     *
     * @param string $noCajas
     *
     * @return Caja
     */
    public function setNoCajas($noCajas)
    {
        $this->noCajas = $noCajas;

        return $this;
    }

    /**
     * Get noCajas
     *
     * @return string
     */
    public function getNoCajas()
    {
        return $this->noCajas;
    }

    /**
     * Set noConsecutivo
     *
     * @param string $noConsecutivo
     *
     * @return Caja
     */
    public function setNoConsecutivo($noConsecutivo)
    {
        $this->noConsecutivo = $noConsecutivo;

        return $this;
    }

    /**
     * Get noConsecutivo
     *
     * @return string
     */
    public function getNoConsecutivo()
    {
        return $this->noConsecutivo;
    }

    /**
     * Set noCorrelativo
     *
     * @param string $noCorrelativo
     *
     * @return Caja
     */
    public function setNoCorrelativo($noCorrelativo)
    {
        $this->noCorrelativo = $noCorrelativo;

        return $this;
    }

    /**
     * Get noCorrelativo
     *
     * @return string
     */
    public function getNoCorrelativo()
    {
        return $this->noCorrelativo;
    }

    /**
     * Set fechaExtremaI
     *
     * @param \DateTime $fechaExtremaI
     *
     * @return Caja
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
     * @return Caja
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
     * Set estanteria
     *
     * @param string $estanteria
     *
     * @return Caja
     */
    public function setEstanteria($estanteria)
    {
        $this->estanteria = $estanteria;

        return $this;
    }

    /**
     * Get estanteria
     *
     * @return string
     */
    public function getEstanteria()
    {
        return $this->estanteria;
    }

    /**
     * Set panel
     *
     * @param integer $panel
     *
     * @return Caja
     */
    public function setPanel($panel)
    {
        $this->panel = $panel;

        return $this;
    }

    /**
     * Get panel
     *
     * @return integer
     */
    public function getPanel()
    {
        return $this->panel;
    }

    /**
     * Set material
     *
     * @param string $material
     *
     * @return Caja
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material
     *
     * @return string
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set seguridad
     *
     * @param string $seguridad
     *
     * @return Caja
     */
    public function setSeguridad($seguridad)
    {
        $this->seguridad = $seguridad;

        return $this;
    }

    /**
     * Get seguridad
     *
     * @return string
     */
    public function getSeguridad()
    {
        return $this->seguridad;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return Caja
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set rutaQr
     *
     * @param string $rutaQr
     *
     * @return Caja
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
     * @return Caja
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
     * Set modulo
     *
     * @param string $modulo
     *
     * @return Caja
     */
    public function setModulo($modulo)
    {
        $this->modulo = $modulo;

        return $this;
    }

    /**
     * Get modulo
     *
     * @return string
     */
    public function getModulo()
    {
        return $this->modulo;
    }

    /**
     * Set nivel
     *
     * @param string $nivel
     *
     * @return Caja
     */
    public function setNivel($nivel)
    {
        $this->nivel = $nivel;

        return $this;
    }

    /**
     * Get nivel
     *
     * @return string
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    /**
     * Set dependenciaIddependencia
     *
     * @param integer $dependenciaIddependencia
     *
     * @return Caja
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
