<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ejecutor
 *
 * @ORM\Table(name="ejecutor", indexes={@ORM\Index(name="i_ejecutor_identificaci", columns={"identificacion"}),@ORM\Index(name="nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Ejecutor
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idejecutor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idejecutor;

    /**
     * @var string
     *
     * @ORM\Column(name="identificacion", type="string", length=50, nullable=true)
     */
    private $identificacion;

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
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_ejecutor", type="integer", nullable=false)
     */
    private $tipoEjecutor = '1';



    /**
     * Get idejecutor
     *
     * @return integer
     */
    public function getIdejecutor()
    {
        return $this->idejecutor;
    }

    /**
     * Set identificacion
     *
     * @param string $identificacion
     *
     * @return Ejecutor
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return string
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Ejecutor
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
     * @return Ejecutor
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
     * Set estado
     *
     * @param integer $estado
     *
     * @return Ejecutor
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set tipoEjecutor
     *
     * @param integer $tipoEjecutor
     *
     * @return Ejecutor
     */
    public function setTipoEjecutor($tipoEjecutor)
    {
        $this->tipoEjecutor = $tipoEjecutor;

        return $this;
    }

    /**
     * Get tipoEjecutor
     *
     * @return integer
     */
    public function getTipoEjecutor()
    {
        return $this->tipoEjecutor;
    }
}
