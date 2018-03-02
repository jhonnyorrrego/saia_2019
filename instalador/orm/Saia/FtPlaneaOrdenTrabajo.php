<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPlaneaOrdenTrabajo
 *
 * @ORM\Table(name="ft_planea_orden_trabajo")
 * @ORM\Entity
 */
class FtPlaneaOrdenTrabajo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_planea_orden_trabajo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftPlaneaOrdenTrabajo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_orden_trabajo_vehiculo", type="integer", nullable=false)
     */
    private $ftOrdenTrabajoVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_orden", type="string", length=255, nullable=false)
     */
    private $descripcionOrden;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_solicitada", type="integer", nullable=false)
     */
    private $cantidadSolicitada;

    /**
     * @var integer
     *
     * @ORM\Column(name="costo_trabajo", type="integer", nullable=false)
     */
    private $costoTrabajo;

    /**
     * @var string
     *
     * @ORM\Column(name="concepto_trabajo", type="string", length=255, nullable=false)
     */
    private $conceptoTrabajo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
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
