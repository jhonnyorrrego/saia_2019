<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Serie
 *
 * @ORM\Table(name="serie", indexes={@ORM\Index(name="cod_padre", columns={"cod_padre"}), @ORM\Index(name="Indice_llave_entidad", columns={"llave_entidad"}), @ORM\Index(name="serie_idserie_PK", columns={"idserie"})})
 * @ORM\Entity
 */
class Serie
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idserie", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idserie;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="cod_padre", type="integer", nullable=true)
     */
    private $codPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="dias_entrega", type="integer", nullable=false)
     */
    private $diasEntrega = '8';

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=20, nullable=true)
     */
    private $codigo;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_entidad", type="integer", nullable=true)
     */
    private $tipoEntidad;

    /**
     * @var string
     *
     * @ORM\Column(name="llave_entidad", type="string", length=100, nullable=true)
     */
    private $llaveEntidad;

    /**
     * @var boolean
     *
     * @ORM\Column(name="retencion_gestion", type="integer", nullable=false)
     */
    private $retencionGestion = '3';

    /**
     * @var boolean
     *
     * @ORM\Column(name="retencion_central", type="integer", nullable=false)
     */
    private $retencionCentral = '5';

    /**
     * @var string
     *
     * @ORM\Column(name="conservacion", type="string", nullable=true)
     */
    private $conservacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="digitalizacion", type="integer", nullable=true)
     */
    private $digitalizacion;

    /**
     * @var boolean
     *
     * @ORM\Column(name="seleccion", type="integer", nullable=true)
     */
    private $seleccion;

    /**
     * @var string
     *
     * @ORM\Column(name="otro", type="string", length=255, nullable=true)
     */
    private $otro;

    /**
     * @var string
     *
     * @ORM\Column(name="procedimiento", type="text", length=65535, nullable=true)
     */
    private $procedimiento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="copia", type="integer", nullable=false)
     */
    private $copia = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo = '0';

    /**
     * @var boolean
     *
     * @ORM\Column(name="clase", type="integer", nullable=true)
     */
    private $clase = '1';

    /**
     * @var boolean
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="categoria", type="integer", nullable=false)
     */
    private $categoria = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="orden", type="string", length=255, nullable=true)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_expediente", type="string", length=255, nullable=true)
     */
    private $tipoExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="tvd", type="integer", nullable=true)
     */
    private $tvd = '0';



    /**
     * Get idserie
     *
     * @return integer
     */
    public function getIdserie()
    {
        return $this->idserie;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Serie
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
     * Set codPadre
     *
     * @param integer $codPadre
     *
     * @return Serie
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
     * Set diasEntrega
     *
     * @param integer $diasEntrega
     *
     * @return Serie
     */
    public function setDiasEntrega($diasEntrega)
    {
        $this->diasEntrega = $diasEntrega;

        return $this;
    }

    /**
     * Get diasEntrega
     *
     * @return integer
     */
    public function getDiasEntrega()
    {
        return $this->diasEntrega;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return Serie
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
     * Set tipoEntidad
     *
     * @param integer $tipoEntidad
     *
     * @return Serie
     */
    public function setTipoEntidad($tipoEntidad)
    {
        $this->tipoEntidad = $tipoEntidad;

        return $this;
    }

    /**
     * Get tipoEntidad
     *
     * @return integer
     */
    public function getTipoEntidad()
    {
        return $this->tipoEntidad;
    }

    /**
     * Set llaveEntidad
     *
     * @param string $llaveEntidad
     *
     * @return Serie
     */
    public function setLlaveEntidad($llaveEntidad)
    {
        $this->llaveEntidad = $llaveEntidad;

        return $this;
    }

    /**
     * Get llaveEntidad
     *
     * @return string
     */
    public function getLlaveEntidad()
    {
        return $this->llaveEntidad;
    }

    /**
     * Set retencionGestion
     *
     * @param boolean $retencionGestion
     *
     * @return Serie
     */
    public function setRetencionGestion($retencionGestion)
    {
        $this->retencionGestion = $retencionGestion;

        return $this;
    }

    /**
     * Get retencionGestion
     *
     * @return boolean
     */
    public function getRetencionGestion()
    {
        return $this->retencionGestion;
    }

    /**
     * Set retencionCentral
     *
     * @param boolean $retencionCentral
     *
     * @return Serie
     */
    public function setRetencionCentral($retencionCentral)
    {
        $this->retencionCentral = $retencionCentral;

        return $this;
    }

    /**
     * Get retencionCentral
     *
     * @return boolean
     */
    public function getRetencionCentral()
    {
        return $this->retencionCentral;
    }

    /**
     * Set conservacion
     *
     * @param string $conservacion
     *
     * @return Serie
     */
    public function setConservacion($conservacion)
    {
        $this->conservacion = $conservacion;

        return $this;
    }

    /**
     * Get conservacion
     *
     * @return string
     */
    public function getConservacion()
    {
        return $this->conservacion;
    }

    /**
     * Set digitalizacion
     *
     * @param boolean $digitalizacion
     *
     * @return Serie
     */
    public function setDigitalizacion($digitalizacion)
    {
        $this->digitalizacion = $digitalizacion;

        return $this;
    }

    /**
     * Get digitalizacion
     *
     * @return boolean
     */
    public function getDigitalizacion()
    {
        return $this->digitalizacion;
    }

    /**
     * Set seleccion
     *
     * @param boolean $seleccion
     *
     * @return Serie
     */
    public function setSeleccion($seleccion)
    {
        $this->seleccion = $seleccion;

        return $this;
    }

    /**
     * Get seleccion
     *
     * @return boolean
     */
    public function getSeleccion()
    {
        return $this->seleccion;
    }

    /**
     * Set otro
     *
     * @param string $otro
     *
     * @return Serie
     */
    public function setOtro($otro)
    {
        $this->otro = $otro;

        return $this;
    }

    /**
     * Get otro
     *
     * @return string
     */
    public function getOtro()
    {
        return $this->otro;
    }

    /**
     * Set procedimiento
     *
     * @param string $procedimiento
     *
     * @return Serie
     */
    public function setProcedimiento($procedimiento)
    {
        $this->procedimiento = $procedimiento;

        return $this;
    }

    /**
     * Get procedimiento
     *
     * @return string
     */
    public function getProcedimiento()
    {
        return $this->procedimiento;
    }

    /**
     * Set copia
     *
     * @param boolean $copia
     *
     * @return Serie
     */
    public function setCopia($copia)
    {
        $this->copia = $copia;

        return $this;
    }

    /**
     * Get copia
     *
     * @return boolean
     */
    public function getCopia()
    {
        return $this->copia;
    }

    /**
     * Set tipo
     *
     * @param boolean $tipo
     *
     * @return Serie
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return boolean
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set clase
     *
     * @param boolean $clase
     *
     * @return Serie
     */
    public function setClase($clase)
    {
        $this->clase = $clase;

        return $this;
    }

    /**
     * Get clase
     *
     * @return boolean
     */
    public function getClase()
    {
        return $this->clase;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     *
     * @return Serie
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
     * Set categoria
     *
     * @param integer $categoria
     *
     * @return Serie
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return integer
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set orden
     *
     * @param string $orden
     *
     * @return Serie
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

    /**
     * Set tipoExpediente
     *
     * @param string $tipoExpediente
     *
     * @return Serie
     */
    public function setTipoExpediente($tipoExpediente)
    {
        $this->tipoExpediente = $tipoExpediente;

        return $this;
    }

    /**
     * Get tipoExpediente
     *
     * @return string
     */
    public function getTipoExpediente()
    {
        return $this->tipoExpediente;
    }

    /**
     * Set tvd
     *
     * @param integer $tvd
     *
     * @return Serie
     */
    public function setTvd($tvd)
    {
        $this->tvd = $tvd;

        return $this;
    }

    /**
     * Get tvd
     *
     * @return integer
     */
    public function getTvd()
    {
        return $this->tvd;
    }
}
