<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asignacion
 *
 * @ORM\Table(name="asignacion", indexes={@ORM\Index(name="i_asignacion_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_asignacion_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class Asignacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idasignacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idasignacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tarea_idtarea", type="integer", nullable=false)
     */
    private $tareaIdtarea;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="datetime", nullable=true)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="datetime", nullable=true)
     */
    private $fechaFinal;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", nullable=false)
     */
    private $estado = 'PENDIENTE';

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_identidad", type="integer", nullable=false)
     */
    private $entidadIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_entidad", type="integer", nullable=false)
     */
    private $llaveEntidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="reprograma", type="integer", nullable=true)
     */
    private $reprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_reprograma", type="string", length=10, nullable=true)
     */
    private $tipoReprograma;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;



    /**
     * Get idasignacion
     *
     * @return integer
     */
    public function getIdasignacion()
    {
        return $this->idasignacion;
    }

    /**
     * Set tareaIdtarea
     *
     * @param integer $tareaIdtarea
     *
     * @return Asignacion
     */
    public function setTareaIdtarea($tareaIdtarea)
    {
        $this->tareaIdtarea = $tareaIdtarea;

        return $this;
    }

    /**
     * Get tareaIdtarea
     *
     * @return integer
     */
    public function getTareaIdtarea()
    {
        return $this->tareaIdtarea;
    }

    /**
     * Set fechaInicial
     *
     * @param \DateTime $fechaInicial
     *
     * @return Asignacion
     */
    public function setFechaInicial($fechaInicial)
    {
        $this->fechaInicial = $fechaInicial;

        return $this;
    }

    /**
     * Get fechaInicial
     *
     * @return \DateTime
     */
    public function getFechaInicial()
    {
        return $this->fechaInicial;
    }

    /**
     * Set fechaFinal
     *
     * @param \DateTime $fechaFinal
     *
     * @return Asignacion
     */
    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;

        return $this;
    }

    /**
     * Get fechaFinal
     *
     * @return \DateTime
     */
    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return Asignacion
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return Asignacion
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
     * Set estado
     *
     * @param string $estado
     *
     * @return Asignacion
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set entidadIdentidad
     *
     * @param integer $entidadIdentidad
     *
     * @return Asignacion
     */
    public function setEntidadIdentidad($entidadIdentidad)
    {
        $this->entidadIdentidad = $entidadIdentidad;

        return $this;
    }

    /**
     * Get entidadIdentidad
     *
     * @return integer
     */
    public function getEntidadIdentidad()
    {
        return $this->entidadIdentidad;
    }

    /**
     * Set llaveEntidad
     *
     * @param integer $llaveEntidad
     *
     * @return Asignacion
     */
    public function setLlaveEntidad($llaveEntidad)
    {
        $this->llaveEntidad = $llaveEntidad;

        return $this;
    }

    /**
     * Get llaveEntidad
     *
     * @return integer
     */
    public function getLlaveEntidad()
    {
        return $this->llaveEntidad;
    }

    /**
     * Set reprograma
     *
     * @param boolean $reprograma
     *
     * @return Asignacion
     */
    public function setReprograma($reprograma)
    {
        $this->reprograma = $reprograma;

        return $this;
    }

    /**
     * Get reprograma
     *
     * @return boolean
     */
    public function getReprograma()
    {
        return $this->reprograma;
    }

    /**
     * Set tipoReprograma
     *
     * @param string $tipoReprograma
     *
     * @return Asignacion
     */
    public function setTipoReprograma($tipoReprograma)
    {
        $this->tipoReprograma = $tipoReprograma;

        return $this;
    }

    /**
     * Get tipoReprograma
     *
     * @return string
     */
    public function getTipoReprograma()
    {
        return $this->tipoReprograma;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Asignacion
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
}
