<?php

namespace Saia;

/**
 * FtTareasActa
 */
class FtTareasActa
{
    /**
     * @var integer
     */
    private $idftTareasActa;

    /**
     * @var integer
     */
    private $ftActa;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var \DateTime
     */
    private $fecha;

    /**
     * @var string
     */
    private $responsable;

    /**
     * @var integer
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

