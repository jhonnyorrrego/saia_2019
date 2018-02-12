<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoFormato
 *
 * @ORM\Table(name="permiso_formato")
 * @ORM\Entity
 */
class PermisoFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpermisoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=false)
     */
    private $formatoIdformato = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idpropietario", type="integer", nullable=false)
     */
    private $idpropietario = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_propio", type="string", length=8, nullable=true)
     */
    private $caracteristicaPropio;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_dependencia", type="string", length=8, nullable=true)
     */
    private $caracteristicaDependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_cargo", type="string", length=8, nullable=true)
     */
    private $caracteristicaCargo;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_total", type="string", length=8, nullable=true)
     */
    private $caracteristicaTotal;



    /**
     * Get idpermisoFormato
     *
     * @return integer
     */
    public function getIdpermisoFormato()
    {
        return $this->idpermisoFormato;
    }

    /**
     * Set formatoIdformato
     *
     * @param integer $formatoIdformato
     *
     * @return PermisoFormato
     */
    public function setFormatoIdformato($formatoIdformato)
    {
        $this->formatoIdformato = $formatoIdformato;

        return $this;
    }

    /**
     * Get formatoIdformato
     *
     * @return integer
     */
    public function getFormatoIdformato()
    {
        return $this->formatoIdformato;
    }

    /**
     * Set idpropietario
     *
     * @param integer $idpropietario
     *
     * @return PermisoFormato
     */
    public function setIdpropietario($idpropietario)
    {
        $this->idpropietario = $idpropietario;

        return $this;
    }

    /**
     * Get idpropietario
     *
     * @return integer
     */
    public function getIdpropietario()
    {
        return $this->idpropietario;
    }

    /**
     * Set caracteristicaPropio
     *
     * @param string $caracteristicaPropio
     *
     * @return PermisoFormato
     */
    public function setCaracteristicaPropio($caracteristicaPropio)
    {
        $this->caracteristicaPropio = $caracteristicaPropio;

        return $this;
    }

    /**
     * Get caracteristicaPropio
     *
     * @return string
     */
    public function getCaracteristicaPropio()
    {
        return $this->caracteristicaPropio;
    }

    /**
     * Set caracteristicaDependencia
     *
     * @param string $caracteristicaDependencia
     *
     * @return PermisoFormato
     */
    public function setCaracteristicaDependencia($caracteristicaDependencia)
    {
        $this->caracteristicaDependencia = $caracteristicaDependencia;

        return $this;
    }

    /**
     * Get caracteristicaDependencia
     *
     * @return string
     */
    public function getCaracteristicaDependencia()
    {
        return $this->caracteristicaDependencia;
    }

    /**
     * Set caracteristicaCargo
     *
     * @param string $caracteristicaCargo
     *
     * @return PermisoFormato
     */
    public function setCaracteristicaCargo($caracteristicaCargo)
    {
        $this->caracteristicaCargo = $caracteristicaCargo;

        return $this;
    }

    /**
     * Get caracteristicaCargo
     *
     * @return string
     */
    public function getCaracteristicaCargo()
    {
        return $this->caracteristicaCargo;
    }

    /**
     * Set caracteristicaTotal
     *
     * @param string $caracteristicaTotal
     *
     * @return PermisoFormato
     */
    public function setCaracteristicaTotal($caracteristicaTotal)
    {
        $this->caracteristicaTotal = $caracteristicaTotal;

        return $this;
    }

    /**
     * Get caracteristicaTotal
     *
     * @return string
     */
    public function getCaracteristicaTotal()
    {
        return $this->caracteristicaTotal;
    }
}
