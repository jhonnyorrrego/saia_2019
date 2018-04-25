<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paso
 *
 * @ORM\Table(name="paso")
 * @ORM\Entity
 */
class Paso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpaso;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="text", length=65535, nullable=false)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_paso", type="string", length=255, nullable=false)
     */
    private $nombrePaso;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="idfigura", type="string", length=255, nullable=false)
     */
    private $idfigura;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="posicion", type="string", length=255, nullable=true)
     */
    private $posicion;

    /**
     * @var string
     *
     * @ORM\Column(name="plazo_paso", type="string", length=255, nullable=true)
     */
    private $plazoPaso;



    /**
     * Get idpaso
     *
     * @return integer
     */
    public function getIdpaso()
    {
        return $this->idpaso;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Paso
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

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return Paso
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set nombrePaso
     *
     * @param string $nombrePaso
     *
     * @return Paso
     */
    public function setNombrePaso($nombrePaso)
    {
        $this->nombrePaso = $nombrePaso;

        return $this;
    }

    /**
     * Get nombrePaso
     *
     * @return string
     */
    public function getNombrePaso()
    {
        return $this->nombrePaso;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return Paso
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
     * Set idfigura
     *
     * @param string $idfigura
     *
     * @return Paso
     */
    public function setIdfigura($idfigura)
    {
        $this->idfigura = $idfigura;

        return $this;
    }

    /**
     * Get idfigura
     *
     * @return string
     */
    public function getIdfigura()
    {
        return $this->idfigura;
    }

    /**
     * Set diagramIddiagram
     *
     * @param integer $diagramIddiagram
     *
     * @return Paso
     */
    public function setDiagramIddiagram($diagramIddiagram)
    {
        $this->diagramIddiagram = $diagramIddiagram;

        return $this;
    }

    /**
     * Get diagramIddiagram
     *
     * @return integer
     */
    public function getDiagramIddiagram()
    {
        return $this->diagramIddiagram;
    }

    /**
     * Set posicion
     *
     * @param string $posicion
     *
     * @return Paso
     */
    public function setPosicion($posicion)
    {
        $this->posicion = $posicion;

        return $this;
    }

    /**
     * Get posicion
     *
     * @return string
     */
    public function getPosicion()
    {
        return $this->posicion;
    }

    /**
     * Set plazoPaso
     *
     * @param string $plazoPaso
     *
     * @return Paso
     */
    public function setPlazoPaso($plazoPaso)
    {
        $this->plazoPaso = $plazoPaso;

        return $this;
    }

    /**
     * Get plazoPaso
     *
     * @return string
     */
    public function getPlazoPaso()
    {
        return $this->plazoPaso;
    }
}
