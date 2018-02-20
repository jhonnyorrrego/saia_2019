<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoAnexo
 *
 * @ORM\Table(name="permiso_anexo", indexes={@ORM\Index(name="i_permiso_anex_idpropietari", columns={"idpropietario"})})
 * @ORM\Entity
 */
class PermisoAnexo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_anexo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpermisoAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_idanexos", type="integer", nullable=false)
     */
    private $anexosIdanexos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idpropietario", type="integer", nullable=true)
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
     * Get idpermisoAnexo
     *
     * @return integer
     */
    public function getIdpermisoAnexo()
    {
        return $this->idpermisoAnexo;
    }

    /**
     * Set anexosIdanexos
     *
     * @param integer $anexosIdanexos
     *
     * @return PermisoAnexo
     */
    public function setAnexosIdanexos($anexosIdanexos)
    {
        $this->anexosIdanexos = $anexosIdanexos;

        return $this;
    }

    /**
     * Get anexosIdanexos
     *
     * @return integer
     */
    public function getAnexosIdanexos()
    {
        return $this->anexosIdanexos;
    }

    /**
     * Set idpropietario
     *
     * @param integer $idpropietario
     *
     * @return PermisoAnexo
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
     * @return PermisoAnexo
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
     * @return PermisoAnexo
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
     * @return PermisoAnexo
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
     * @return PermisoAnexo
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
