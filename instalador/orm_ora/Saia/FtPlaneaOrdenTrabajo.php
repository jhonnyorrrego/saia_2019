<?php

namespace Saia;

/**
 * FtPlaneaOrdenTrabajo
 */
class FtPlaneaOrdenTrabajo
{
    /**
     * @var integer
     */
    private $idftPlaneaOrdenTrabajo;

    /**
     * @var integer
     */
    private $ftOrdenTrabajoVehiculo;

    /**
     * @var string
     */
    private $descripcionOrden;

    /**
     * @var integer
     */
    private $cantidadSolicitada;

    /**
     * @var integer
     */
    private $costoTrabajo;

    /**
     * @var string
     */
    private $conceptoTrabajo;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftPlaneaOrdenTrabajo
     *
     * @return integer
     */
    public function getIdftPlaneaOrdenTrabajo()
    {
        return $this->idftPlaneaOrdenTrabajo;
    }

    /**
     * Set ftOrdenTrabajoVehiculo
     *
     * @param integer $ftOrdenTrabajoVehiculo
     *
     * @return FtPlaneaOrdenTrabajo
     */
    public function setFtOrdenTrabajoVehiculo($ftOrdenTrabajoVehiculo)
    {
        $this->ftOrdenTrabajoVehiculo = $ftOrdenTrabajoVehiculo;

        return $this;
    }

    /**
     * Get ftOrdenTrabajoVehiculo
     *
     * @return integer
     */
    public function getFtOrdenTrabajoVehiculo()
    {
        return $this->ftOrdenTrabajoVehiculo;
    }

    /**
     * Set descripcionOrden
     *
     * @param string $descripcionOrden
     *
     * @return FtPlaneaOrdenTrabajo
     */
    public function setDescripcionOrden($descripcionOrden)
    {
        $this->descripcionOrden = $descripcionOrden;

        return $this;
    }

    /**
     * Get descripcionOrden
     *
     * @return string
     */
    public function getDescripcionOrden()
    {
        return $this->descripcionOrden;
    }

    /**
     * Set cantidadSolicitada
     *
     * @param integer $cantidadSolicitada
     *
     * @return FtPlaneaOrdenTrabajo
     */
    public function setCantidadSolicitada($cantidadSolicitada)
    {
        $this->cantidadSolicitada = $cantidadSolicitada;

        return $this;
    }

    /**
     * Get cantidadSolicitada
     *
     * @return integer
     */
    public function getCantidadSolicitada()
    {
        return $this->cantidadSolicitada;
    }

    /**
     * Set costoTrabajo
     *
     * @param integer $costoTrabajo
     *
     * @return FtPlaneaOrdenTrabajo
     */
    public function setCostoTrabajo($costoTrabajo)
    {
        $this->costoTrabajo = $costoTrabajo;

        return $this;
    }

    /**
     * Get costoTrabajo
     *
     * @return integer
     */
    public function getCostoTrabajo()
    {
        return $this->costoTrabajo;
    }

    /**
     * Set conceptoTrabajo
     *
     * @param string $conceptoTrabajo
     *
     * @return FtPlaneaOrdenTrabajo
     */
    public function setConceptoTrabajo($conceptoTrabajo)
    {
        $this->conceptoTrabajo = $conceptoTrabajo;

        return $this;
    }

    /**
     * Get conceptoTrabajo
     *
     * @return string
     */
    public function getConceptoTrabajo()
    {
        return $this->conceptoTrabajo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPlaneaOrdenTrabajo
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

