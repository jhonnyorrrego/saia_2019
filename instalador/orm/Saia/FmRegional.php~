<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FmRegional
 *
 * @ORM\Table(name="fm_regional", indexes={@ORM\Index(name="i_reginal_nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class FmRegional
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idregional", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idregional;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;



    /**
     * Get idregional
     *
     * @return integer
     */
    public function getIdregional()
    {
        return $this->idregional;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FmRegional
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FmRegional
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
