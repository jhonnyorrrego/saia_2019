<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * BuzonEntrada
 *
 * @ORM\Table(name="buzon_entrada", indexes={@ORM\Index(name="i_buzon_entrad_fecha", columns={"fecha"}), @ORM\Index(name="i_buzon_entrad_destino", columns={"destino"}), @ORM\Index(name="i_buzon_entrad_ruta_idruta", columns={"ruta_idruta"}), @ORM\Index(name="i_buzon_entrad_archivo_idar", columns={"archivo_idarchivo"}), @ORM\Index(name="i_buzon_entrad_origen", columns={"origen"})})
 * @ORM\Entity
 */
class BuzonEntrada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idtransferencia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idtransferencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="archivo_idarchivo", type="integer", nullable=false)
     */
    private $archivoIdarchivo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", nullable=false)
     */
    private $nombre = 'RECEPCION';

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="string", length=20, nullable=true)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=true)
     */
    private $tipoDestino;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="respuesta", type="date", nullable=true)
     */
    private $respuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=false)
     */
    private $origen = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=true)
     */
    private $tipoOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="notas", type="text", length=65535, nullable=true)
     */
    private $notas;

    /**
     * @var string
     *
     * @ORM\Column(name="transferencia_descripcion", type="text", length=65535, nullable=true)
     */
    private $transferenciaDescripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", nullable=false)
     */
    private $tipo = 'ARCHIVO';

    /**
     * @var boolean
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta_idruta", type="integer", nullable=false)
     */
    private $rutaIdruta;

    /**
     * @var string
     *
     * @ORM\Column(name="ver_notas", type="string", length=1, nullable=true)
     */
    private $verNotas = '0';



    /**
     * Get idtransferencia
     *
     * @return integer
     */
    public function getIdtransferencia()
    {
        return $this->idtransferencia;
    }

    /**
     * Set archivoIdarchivo
     *
     * @param integer $archivoIdarchivo
     *
     * @return BuzonEntrada
     */
    public function setArchivoIdarchivo($archivoIdarchivo)
    {
        $this->archivoIdarchivo = $archivoIdarchivo;

        return $this;
    }

    /**
     * Get archivoIdarchivo
     *
     * @return integer
     */
    public function getArchivoIdarchivo()
    {
        return $this->archivoIdarchivo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return BuzonEntrada
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
     * Set destino
     *
     * @param string $destino
     *
     * @return BuzonEntrada
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set tipoDestino
     *
     * @param integer $tipoDestino
     *
     * @return BuzonEntrada
     */
    public function setTipoDestino($tipoDestino)
    {
        $this->tipoDestino = $tipoDestino;

        return $this;
    }

    /**
     * Get tipoDestino
     *
     * @return integer
     */
    public function getTipoDestino()
    {
        return $this->tipoDestino;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return BuzonEntrada
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
     * Set respuesta
     *
     * @param \DateTime $respuesta
     *
     * @return BuzonEntrada
     */
    public function setRespuesta($respuesta)
    {
        $this->respuesta = $respuesta;

        return $this;
    }

    /**
     * Get respuesta
     *
     * @return \DateTime
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set origen
     *
     * @param string $origen
     *
     * @return BuzonEntrada
     */
    public function setOrigen($origen)
    {
        $this->origen = $origen;

        return $this;
    }

    /**
     * Get origen
     *
     * @return string
     */
    public function getOrigen()
    {
        return $this->origen;
    }

    /**
     * Set tipoOrigen
     *
     * @param integer $tipoOrigen
     *
     * @return BuzonEntrada
     */
    public function setTipoOrigen($tipoOrigen)
    {
        $this->tipoOrigen = $tipoOrigen;

        return $this;
    }

    /**
     * Get tipoOrigen
     *
     * @return integer
     */
    public function getTipoOrigen()
    {
        return $this->tipoOrigen;
    }

    /**
     * Set notas
     *
     * @param string $notas
     *
     * @return BuzonEntrada
     */
    public function setNotas($notas)
    {
        $this->notas = $notas;

        return $this;
    }

    /**
     * Get notas
     *
     * @return string
     */
    public function getNotas()
    {
        return $this->notas;
    }

    /**
     * Set transferenciaDescripcion
     *
     * @param string $transferenciaDescripcion
     *
     * @return BuzonEntrada
     */
    public function setTransferenciaDescripcion($transferenciaDescripcion)
    {
        $this->transferenciaDescripcion = $transferenciaDescripcion;

        return $this;
    }

    /**
     * Get transferenciaDescripcion
     *
     * @return string
     */
    public function getTransferenciaDescripcion()
    {
        return $this->transferenciaDescripcion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return BuzonEntrada
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set activo
     *
     * @param boolean $activo
     *
     * @return BuzonEntrada
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return boolean
     */
    public function getActivo()
    {
        return $this->activo;
    }

    /**
     * Set rutaIdruta
     *
     * @param integer $rutaIdruta
     *
     * @return BuzonEntrada
     */
    public function setRutaIdruta($rutaIdruta)
    {
        $this->rutaIdruta = $rutaIdruta;

        return $this;
    }

    /**
     * Get rutaIdruta
     *
     * @return integer
     */
    public function getRutaIdruta()
    {
        return $this->rutaIdruta;
    }

    /**
     * Set verNotas
     *
     * @param string $verNotas
     *
     * @return BuzonEntrada
     */
    public function setVerNotas($verNotas)
    {
        $this->verNotas = $verNotas;

        return $this;
    }

    /**
     * Get verNotas
     *
     * @return string
     */
    public function getVerNotas()
    {
        return $this->verNotas;
    }
}
