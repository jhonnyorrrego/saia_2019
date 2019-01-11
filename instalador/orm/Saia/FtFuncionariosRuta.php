<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFuncionariosRuta
 *
 * @ORM\Table(name="ft_funcionarios_ruta", indexes={@ORM\Index(name="i_funcionarios_ruta_ruta_distr", columns={"ft_ruta_distribucion"}), @ORM\Index(name="i_funcionarios_ruta_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtFuncionariosRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_funcionarios_ruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFuncionariosRuta;

    /**
     * @var string
     *
     * @ORM\Column(name="mensajero_ruta", type="string", length=255, nullable=false)
     */
    private $mensajeroRuta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_ruta_distribucion", type="integer", nullable=false)
     */
    private $ftRutaDistribucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_mensajero", type="date", nullable=false)
     */
    private $fechaMensajero;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_mensajero", type="integer", nullable=false)
     */
    private $estadoMensajero = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;



    /**
     * Get idftFuncionariosRuta
     *
     * @return integer
     */
    public function getIdftFuncionariosRuta()
    {
        return $this->idftFuncionariosRuta;
    }

    /**
     * Set mensajeroRuta
     *
     * @param string $mensajeroRuta
     *
     * @return FtFuncionariosRuta
     */
    public function setMensajeroRuta($mensajeroRuta)
    {
        $this->mensajeroRuta = $mensajeroRuta;

        return $this;
    }

    /**
     * Get mensajeroRuta
     *
     * @return string
     */
    public function getMensajeroRuta()
    {
        return $this->mensajeroRuta;
    }

    /**
     * Set ftRutaDistribucion
     *
     * @param integer $ftRutaDistribucion
     *
     * @return FtFuncionariosRuta
     */
    public function setFtRutaDistribucion($ftRutaDistribucion)
    {
        $this->ftRutaDistribucion = $ftRutaDistribucion;

        return $this;
    }

    /**
     * Get ftRutaDistribucion
     *
     * @return integer
     */
    public function getFtRutaDistribucion()
    {
        return $this->ftRutaDistribucion;
    }

    /**
     * Set fechaMensajero
     *
     * @param \DateTime $fechaMensajero
     *
     * @return FtFuncionariosRuta
     */
    public function setFechaMensajero($fechaMensajero)
    {
        $this->fechaMensajero = $fechaMensajero;

        return $this;
    }

    /**
     * Get fechaMensajero
     *
     * @return \DateTime
     */
    public function getFechaMensajero()
    {
        return $this->fechaMensajero;
    }

    /**
     * Set estadoMensajero
     *
     * @param integer $estadoMensajero
     *
     * @return FtFuncionariosRuta
     */
    public function setEstadoMensajero($estadoMensajero)
    {
        $this->estadoMensajero = $estadoMensajero;

        return $this;
    }

    /**
     * Get estadoMensajero
     *
     * @return integer
     */
    public function getEstadoMensajero()
    {
        return $this->estadoMensajero;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFuncionariosRuta
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
