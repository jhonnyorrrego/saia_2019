<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstadoDocumento
 *
 * @ORM\Table(name="estado_documento", uniqueConstraints={@ORM\UniqueConstraint(name="estado", columns={"estado"})})
 * @ORM\Entity
 */
class EstadoDocumento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idestado_documento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idestadoDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="en_uso", type="integer", nullable=false)
     */
    private $enUso = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;



    /**
     * Get idestadoDocumento
     *
     * @return integer
     */
    public function getIdestadoDocumento()
    {
        return $this->idestadoDocumento;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return EstadoDocumento
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
     * Set enUso
     *
     * @param integer $enUso
     *
     * @return EstadoDocumento
     */
    public function setEnUso($enUso)
    {
        $this->enUso = $enUso;

        return $this;
    }

    /**
     * Get enUso
     *
     * @return integer
     */
    public function getEnUso()
    {
        return $this->enUso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return EstadoDocumento
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
