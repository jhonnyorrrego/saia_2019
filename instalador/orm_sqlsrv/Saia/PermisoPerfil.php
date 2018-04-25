<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoPerfil
 *
 * @ORM\Table(name="permiso_perfil")
 * @ORM\Entity
 */
class PermisoPerfil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_perfil", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpermisoPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="perfil_idperfil", type="integer", nullable=false)
     */
    private $perfilIdperfil = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_propio", type="string", length=15, nullable=true)
     */
    private $caracteristicaPropio;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_grupo", type="string", length=15, nullable=true)
     */
    private $caracteristicaGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_total", type="string", length=15, nullable=true)
     */
    private $caracteristicaTotal;



    /**
     * Get idpermisoPerfil
     *
     * @return integer
     */
    public function getIdpermisoPerfil()
    {
        return $this->idpermisoPerfil;
    }

    /**
     * Set moduloIdmodulo
     *
     * @param integer $moduloIdmodulo
     *
     * @return PermisoPerfil
     */
    public function setModuloIdmodulo($moduloIdmodulo)
    {
        $this->moduloIdmodulo = $moduloIdmodulo;

        return $this;
    }

    /**
     * Get moduloIdmodulo
     *
     * @return integer
     */
    public function getModuloIdmodulo()
    {
        return $this->moduloIdmodulo;
    }

    /**
     * Set perfilIdperfil
     *
     * @param integer $perfilIdperfil
     *
     * @return PermisoPerfil
     */
    public function setPerfilIdperfil($perfilIdperfil)
    {
        $this->perfilIdperfil = $perfilIdperfil;

        return $this;
    }

    /**
     * Get perfilIdperfil
     *
     * @return integer
     */
    public function getPerfilIdperfil()
    {
        return $this->perfilIdperfil;
    }

    /**
     * Set caracteristicaPropio
     *
     * @param string $caracteristicaPropio
     *
     * @return PermisoPerfil
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
     * Set caracteristicaGrupo
     *
     * @param string $caracteristicaGrupo
     *
     * @return PermisoPerfil
     */
    public function setCaracteristicaGrupo($caracteristicaGrupo)
    {
        $this->caracteristicaGrupo = $caracteristicaGrupo;

        return $this;
    }

    /**
     * Get caracteristicaGrupo
     *
     * @return string
     */
    public function getCaracteristicaGrupo()
    {
        return $this->caracteristicaGrupo;
    }

    /**
     * Set caracteristicaTotal
     *
     * @param string $caracteristicaTotal
     *
     * @return PermisoPerfil
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
