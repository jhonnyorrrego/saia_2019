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



    /**
     * Get idfolder
     *
     * @return integer
     */
    public function getIdfolder()
    {
        return $this->idfolder;
    }

    /**
     * Set cajaIdcaja
     *
     * @param integer $cajaIdcaja
     *
     * @return Folder
     */
    public function setCajaIdcaja($cajaIdcaja)
    {
        $this->cajaIdcaja = $cajaIdcaja;

        return $this;
    }

    /**
     * Get cajaIdcaja
     *
     * @return integer
     */
    public function getCajaIdcaja()
    {
        return $this->cajaIdcaja;
    }

    /**
     * Set unidadAdmin
     *
     * @param string $unidadAdmin
     *
     * @return Folder
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
     * Set subseccionI
     *
     * @param string $subseccionI
     *
     * @return Folder
     */
    public function setSubseccionI($subseccionI)
    {
        $this->subseccionI = $subseccionI;

        return $this;
    }

    /**
     * Get subseccionI
     *
     * @return string
     */
    public function getSubseccionI()
    {
        return $this->subseccionI;
    }

    /**
     * Set subseccionIi
     *
     * @param string $subseccionIi
     *
     * @return Folder
     */
    public function setSubseccionIi($subseccionIi)
    {
        $this->subseccionIi = $subseccionIi;

        return $this;
    }

    /**
     * Get subseccionIi
     *
     * @return string
     */
    public function getSubseccionIi()
    {
        return $this->subseccionIi;
    }

    /**
     * Set numeroOrden
     *
     * @param string $numeroOrden
     *
     * @return Folder
     */
    public function setNumeroOrden($numeroOrden)
    {
        $this->numeroOrden = $numeroOrden;

        return $this;
    }

    /**
     * Get numeroOrden
     *
     * @return string
     */
    public function getNumeroOrden()
    {
        return $this->numeroOrden;
    }

    /**
     * Set nombreExpediente
     *
     * @param string $nombreExpediente
     *
     * @return Folder
     */
    public function setNombreExpediente($nombreExpediente)
    {
        $this->nombreExpediente = $nombreExpediente;

        return $this;
    }

    /**
     * Get nombreExpediente
     *
     * @return string
     */
    public function getNombreExpediente()
    {
        return $this->nombreExpediente;
    }

    /**
     * Set noTomo
     *
     * @param string $noTomo
     *
     * @return Folder
     */
    public function setNoTomo($noTomo)
    {
        $this->noTomo = $noTomo;

        return $this;
    }

    /**
     * Get noTomo
     *
     * @return string
     */
    public function getNoTomo()
    {
        return $this->noTomo;
    }

    /**
     * Set codigoNumero
     *
     * @param string $codigoNumero
     *
     * @return Folder
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
     * @return Folder
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return Folder
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
     * Set fechaExtremaI
     *
     * @param \DateTime $fechaExtremaI
     *
     * @return Folder
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
     * @return Folder
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
     * @return Folder
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
     * @return Folder
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
     * @return Folder
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
     * @return Folder
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
     * @return Folder
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
     * @return Folder
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
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return Folder
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
}
