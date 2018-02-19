<?php

namespace Saia;

/**
 * PantallaFuncionExe
 */
class PantallaFuncionExe
{
    /**
     * @var integer
     */
    private $idpantallaFuncionExe;

    /**
     * @var string
     */
    private $accion;

    /**
     * @var integer
     */
    private $momento;

    /**
     * @var string
     */
    private $vistas;

    /**
     * @var integer
     */
    private $orden;

    /**
     * @var integer
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     */
    private $fkIdpantallaFuncion;


    /**
     * Get idpantallaFuncionExe
     *
     * @return integer
     */
    public function getIdpantallaFuncionExe()
    {
        return $this->idpantallaFuncionExe;
    }

    /**
     * Set accion
     *
     * @param string $accion
     *
     * @return PantallaFuncionExe
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return string
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set momento
     *
     * @param integer $momento
     *
     * @return PantallaFuncionExe
     */
    public function setMomento($momento)
    {
        $this->momento = $momento;

        return $this;
    }

    /**
     * Get momento
     *
     * @return integer
     */
    public function getMomento()
    {
        return $this->momento;
    }

    /**
     * Set vistas
     *
     * @param string $vistas
     *
     * @return PantallaFuncionExe
     */
    public function setVistas($vistas)
    {
        $this->vistas = $vistas;

        return $this;
    }

    /**
     * Get vistas
     *
     * @return string
     */
    public function getVistas()
    {
        return $this->vistas;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return PantallaFuncionExe
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set pantallaIdpantalla
     *
     * @param integer $pantallaIdpantalla
     *
     * @return PantallaFuncionExe
     */
    public function setPantallaIdpantalla($pantallaIdpantalla)
    {
        $this->pantallaIdpantalla = $pantallaIdpantalla;

        return $this;
    }

    /**
     * Get pantallaIdpantalla
     *
     * @return integer
     */
    public function getPantallaIdpantalla()
    {
        return $this->pantallaIdpantalla;
    }

    /**
     * Set fkIdpantallaFuncion
     *
     * @param integer $fkIdpantallaFuncion
     *
     * @return PantallaFuncionExe
     */
    public function setFkIdpantallaFuncion($fkIdpantallaFuncion)
    {
        $this->fkIdpantallaFuncion = $fkIdpantallaFuncion;

        return $this;
    }

    /**
     * Get fkIdpantallaFuncion
     *
     * @return integer
     */
    public function getFkIdpantallaFuncion()
    {
        return $this->fkIdpantallaFuncion;
    }
}

