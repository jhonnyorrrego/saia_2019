<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtTareasActa
 *
 * @ORM\Table(name="ft_tareas_acta", indexes={@ORM\Index(name="i_tareas_acta_acta", columns={"ft_acta"}), @ORM\Index(name="i_tareas_acta_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtTareasActa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_tareas_acta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftTareasActa;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_acta", type="integer", nullable=false)
     */
    private $ftActa;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;



    /**
     * Get idftTareasActa
     *
     * @return integer
     */
    public function getIdftTareasActa()
    {
        return $this->idftTareasActa;
    }

    /**
     * Set ftActa
     *
     * @param integer $ftActa
     *
     * @return FtTareasActa
     */
    public function setFtActa($ftActa)
    {
        $this->ftActa = $ftActa;

        return $this;
    }

    /**
     * Get ftActa
     *
     * @return integer
     */
    public function getFtActa()
    {
        return $this->ftActa;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtTareasActa
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
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtTareasActa
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
     * Set responsable
     *
     * @param string $responsable
     *
     * @return FtTareasActa
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtTareasActa
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
}
