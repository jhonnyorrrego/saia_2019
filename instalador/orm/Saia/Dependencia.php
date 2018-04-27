<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dependencia
 *
 * @ORM\Table(name="dependencia")
 * @ORM\Entity
 */
class Dependencia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddependencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=50, nullable=true)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime", nullable=false)
     */
    private $fechaIngreso = 'CURRENT_TIMESTAMP';

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo_tabla", type="string", length=255, nullable=true)
     */
    private $codigoTabla;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=20, nullable=true)
     */
    private $extension;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion_dependencia", type="text", length=65535, nullable=true)
     */
    private $ubicacionDependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="blob", length=65535, nullable=true)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="orden", type="string", length=255, nullable=true)
     */
    private $orden;



    /**
     * Get iddependencia
     *
     * @return integer
     */
    public function getIddependencia()
    {
        return $this->iddependencia;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Dependencia
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Dependencia
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
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return Dependencia
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return Dependencia
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
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return Dependencia
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Dependencia
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set codigoTabla
     *
     * @param string $codigoTabla
     *
     * @return Dependencia
     */
    public function setCodigoTabla($codigoTabla)
    {
        $this->codigoTabla = $codigoTabla;

        return $this;
    }

    /**
     * Get codigoTabla
     *
     * @return string
     */
    public function getCodigoTabla()
    {
        return $this->codigoTabla;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return Dependencia
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set ubicacionDependencia
     *
     * @param string $ubicacionDependencia
     *
     * @return Dependencia
     */
    public function setUbicacionDependencia($ubicacionDependencia)
    {
        $this->ubicacionDependencia = $ubicacionDependencia;

        return $this;
    }

    /**
     * Get ubicacionDependencia
     *
     * @return string
     */
    public function getUbicacionDependencia()
    {
        return $this->ubicacionDependencia;
    }

    /**
     * Set logo
     *
     * @param string $logo
     *
     * @return Dependencia
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set orden
     *
     * @param string $orden
     *
     * @return Dependencia
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return string
     */
    public function getOrden()
    {
        return $this->orden;
    }
}
