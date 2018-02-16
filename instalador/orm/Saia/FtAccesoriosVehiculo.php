<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAccesoriosVehiculo
 *
 * @ORM\Table(name="ft_accesorios_vehiculo")
 * @ORM\Entity
 */
class FtAccesoriosVehiculo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_accesorios_vehiculo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftAccesoriosVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_datos_vehiculo", type="integer", nullable=false)
     */
    private $ftDatosVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="accesorio_vehiculo", type="string", length=255, nullable=false)
     */
    private $accesorioVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_accesorio", type="integer", nullable=false)
     */
    private $valorAccesorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;



    /**
     * Get idftAccesoriosVehiculo
     *
     * @return integer
     */
    public function getIdftAccesoriosVehiculo()
    {
        return $this->idftAccesoriosVehiculo;
    }

    /**
     * Set ftDatosVehiculo
     *
     * @param integer $ftDatosVehiculo
     *
     * @return FtAccesoriosVehiculo
     */
    public function setFtDatosVehiculo($ftDatosVehiculo)
    {
        $this->ftDatosVehiculo = $ftDatosVehiculo;

        return $this;
    }

    /**
     * Get ftDatosVehiculo
     *
     * @return integer
     */
    public function getFtDatosVehiculo()
    {
        return $this->ftDatosVehiculo;
    }

    /**
     * Set accesorioVehiculo
     *
     * @param string $accesorioVehiculo
     *
     * @return FtAccesoriosVehiculo
     */
    public function setAccesorioVehiculo($accesorioVehiculo)
    {
        $this->accesorioVehiculo = $accesorioVehiculo;

        return $this;
    }

    /**
     * Get accesorioVehiculo
     *
     * @return string
     */
    public function getAccesorioVehiculo()
    {
        return $this->accesorioVehiculo;
    }

    /**
     * Set valorAccesorio
     *
     * @param integer $valorAccesorio
     *
     * @return FtAccesoriosVehiculo
     */
    public function setValorAccesorio($valorAccesorio)
    {
        $this->valorAccesorio = $valorAccesorio;

        return $this;
    }

    /**
     * Get valorAccesorio
     *
     * @return integer
     */
    public function getValorAccesorio()
    {
        return $this->valorAccesorio;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAccesoriosVehiculo
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
