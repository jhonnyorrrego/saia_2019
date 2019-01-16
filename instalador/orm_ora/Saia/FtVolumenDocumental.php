<?php

namespace Saia;

/**
 * FtVolumenDocumental
 */
class FtVolumenDocumental
{
    /**
     * @var integer
     */
    private $idftVolumenDocumental;

    /**
     * @var integer
     */
    private $ftReadh;

    /**
     * @var integer
     */
    private $tipoSoporte;

    /**
     * @var integer
     */
    private $cantidad;

    /**
     * @var string
     */
    private $riesgos;

    /**
     * @var string
     */
    private $descripcionVolumen;

    /**
     * @var integer
     */
    private $nivelPertinencia;


    /**
     * Get idftVolumenDocumental
     *
     * @return integer
     */
    public function getIdftVolumenDocumental()
    {
        return $this->idftVolumenDocumental;
    }

    /**
     * Set ftReadh
     *
     * @param integer $ftReadh
     *
     * @return FtVolumenDocumental
     */
    public function setFtReadh($ftReadh)
    {
        $this->ftReadh = $ftReadh;

        return $this;
    }

    /**
     * Get ftReadh
     *
     * @return integer
     */
    public function getFtReadh()
    {
        return $this->ftReadh;
    }

    /**
     * Set tipoSoporte
     *
     * @param integer $tipoSoporte
     *
     * @return FtVolumenDocumental
     */
    public function setTipoSoporte($tipoSoporte)
    {
        $this->tipoSoporte = $tipoSoporte;

        return $this;
    }

    /**
     * Get tipoSoporte
     *
     * @return integer
     */
    public function getTipoSoporte()
    {
        return $this->tipoSoporte;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return FtVolumenDocumental
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set riesgos
     *
     * @param string $riesgos
     *
     * @return FtVolumenDocumental
     */
    public function setRiesgos($riesgos)
    {
        $this->riesgos = $riesgos;

        return $this;
    }

    /**
     * Get riesgos
     *
     * @return string
     */
    public function getRiesgos()
    {
        return $this->riesgos;
    }

    /**
     * Set descripcionVolumen
     *
     * @param string $descripcionVolumen
     *
     * @return FtVolumenDocumental
     */
    public function setDescripcionVolumen($descripcionVolumen)
    {
        $this->descripcionVolumen = $descripcionVolumen;

        return $this;
    }

    /**
     * Get descripcionVolumen
     *
     * @return string
     */
    public function getDescripcionVolumen()
    {
        return $this->descripcionVolumen;
    }

    /**
     * Set nivelPertinencia
     *
     * @param integer $nivelPertinencia
     *
     * @return FtVolumenDocumental
     */
    public function setNivelPertinencia($nivelPertinencia)
    {
        $this->nivelPertinencia = $nivelPertinencia;

        return $this;
    }

    /**
     * Get nivelPertinencia
     *
     * @return integer
     */
    public function getNivelPertinencia()
    {
        return $this->nivelPertinencia;
    }
}

