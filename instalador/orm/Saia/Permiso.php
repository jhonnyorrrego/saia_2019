<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permiso
 *
 * @ORM\Table(name="permiso")
 * @ORM\Entity
 */
class Permiso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpermiso;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="accion", type="integer", nullable=true)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

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
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo = '1';



    /**
     * Get idpermiso
     *
     * @return integer
     */
    public function getIdpermiso()
    {
        return $this->idpermiso;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return Permiso
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set accion
     *
     * @param integer $accion
     *
     * @return Permiso
     */
    public function setAccion($accion)
    {
        $this->accion = $accion;

        return $this;
    }

    /**
     * Get accion
     *
     * @return integer
     */
    public function getAccion()
    {
        return $this->accion;
    }

    /**
     * Set moduloIdmodulo
     *
     * @param integer $moduloIdmodulo
     *
     * @return Permiso
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
     * Set caracteristicaPropio
     *
     * @param string $caracteristicaPropio
     *
     * @return Permiso
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
     * @return Permiso
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
     * @return Permiso
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

    /**
     * Set tipo
     *
     * @param boolean $tipo
     *
     * @return Permiso
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return boolean
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}
