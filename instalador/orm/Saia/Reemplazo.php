<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reemplazo
 *
 * @ORM\Table(name="reemplazo", indexes={@ORM\Index(name="i_reemplazo_nuevo", columns={"nuevo"}), @ORM\Index(name="i_reemplazo_cargo_nuevo", columns={"cargo_nuevo"}), @ORM\Index(name="i_reemplazo_antiguo", columns={"antiguo"})})
 * @ORM\Entity
 */
class Reemplazo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idreemplazo;

    /**
     * @var integer
     *
     * @ORM\Column(name="antiguo", type="integer", nullable=false)
     */
    private $antiguo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="nuevo", type="integer", nullable=false)
     */
    private $nuevo = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="datetime", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="datetime", nullable=true)
     */
    private $fechaFin;

    /**
     * @var integer
     *
     * @ORM\Column(name="cargo_nuevo", type="integer", nullable=false)
     */
    private $cargoNuevo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="activo", type="string", length=1, nullable=false)
     */
    private $activo = '1';



    /**
     * Get idreemplazo
     *
     * @return integer
     */
    public function getIdreemplazo()
    {
        return $this->idreemplazo;
    }

    /**
     * Set antiguo
     *
     * @param integer $antiguo
     *
     * @return Reemplazo
     */
    public function setAntiguo($antiguo)
    {
        $this->antiguo = $antiguo;

        return $this;
    }

    /**
     * Get antiguo
     *
     * @return integer
     */
    public function getAntiguo()
    {
        return $this->antiguo;
    }

    /**
     * Set nuevo
     *
     * @param integer $nuevo
     *
     * @return Reemplazo
     */
    public function setNuevo($nuevo)
    {
        $this->nuevo = $nuevo;

        return $this;
    }

    /**
     * Get nuevo
     *
     * @return integer
     */
    public function getNuevo()
    {
        return $this->nuevo;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return Reemplazo
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return Reemplazo
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set cargoNuevo
     *
     * @param integer $cargoNuevo
     *
     * @return Reemplazo
     */
    public function setCargoNuevo($cargoNuevo)
    {
        $this->cargoNuevo = $cargoNuevo;

        return $this;
    }

    /**
     * Get cargoNuevo
     *
     * @return integer
     */
    public function getCargoNuevo()
    {
        return $this->cargoNuevo;
    }

    /**
     * Set activo
     *
     * @param string $activo
     *
     * @return Reemplazo
     */
    public function setActivo($activo)
    {
        $this->activo = $activo;

        return $this;
    }

    /**
     * Get activo
     *
     * @return string
     */
    public function getActivo()
    {
        return $this->activo;
    }
}
