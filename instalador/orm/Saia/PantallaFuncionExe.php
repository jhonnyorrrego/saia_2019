<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncionExe
 *
 * @ORM\Table(name="pantalla_funcion_exe", indexes={@ORM\Index(name="fk_pantalla_funcion_exe_pantalla1_idx", columns={"pantalla_idpantalla"}), @ORM\Index(name="fk_pantalla_funcion_exe_pantalla_funcion1_idx", columns={"fk_idpantalla_funcion"})})
 * @ORM\Entity
 */
class PantallaFuncionExe
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_funcion_exe", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaFuncionExe;

    /**
     * @var string
     *
     * @ORM\Column(name="accion", type="string", length=255, nullable=false)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="momento", type="integer", nullable=false)
     */
    private $momento = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="vistas", type="string", length=50, nullable=false)
     */
    private $vistas = 'v';

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla_funcion", type="integer", nullable=false)
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
