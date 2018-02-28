<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReemplazoSaia
 *
 * @ORM\Table(name="reemplazo_saia")
 * @ORM\Entity
 */
class ReemplazoSaia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreemplazo_saia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idreemplazoSaia;

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
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=true)
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
     * @ORM\Column(name="estado", type="string", length=1, nullable=false)
     */
    private $estado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_reemplazo", type="integer", nullable=false)
     */
    private $tipoReemplazo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;



    /**
     * Get idreemplazoSaia
     *
     * @return integer
     */
    public function getIdreemplazoSaia()
    {
        return $this->idreemplazoSaia;
    }

    /**
     * Set antiguo
     *
     * @param integer $antiguo
     *
     * @return ReemplazoSaia
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
     * @return ReemplazoSaia
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
     * @return ReemplazoSaia
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
     * @return ReemplazoSaia
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
     * @return ReemplazoSaia
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
     * Set estado
     *
     * @param string $estado
     *
     * @return ReemplazoSaia
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
     * Set tipoReemplazo
     *
     * @param integer $tipoReemplazo
     *
     * @return ReemplazoSaia
     */
    public function setTipoReemplazo($tipoReemplazo)
    {
        $this->tipoReemplazo = $tipoReemplazo;

        return $this;
    }

    /**
     * Get tipoReemplazo
     *
     * @return integer
     */
    public function getTipoReemplazo()
    {
        return $this->tipoReemplazo;
    }

    /**
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return ReemplazoSaia
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }
}
