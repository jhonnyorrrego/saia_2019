<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoFuncionario
 *
 * @ORM\Table(name="permiso_funcionario", indexes={@ORM\Index(name="i_permiso_func_asignado_por", columns={"asignado_por"}), @ORM\Index(name="i_permiso_func_entidad_comp", columns={"entidad_compartida"})})
 * @ORM\Entity
 */
class PermisoFuncionario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_funcionario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpermisoFuncionario;

    /**
     * @var boolean
     *
     * @ORM\Column(name="entidad_propietaria", type="boolean", nullable=false)
     */
    private $entidadPropietaria;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_propietaria", type="integer", nullable=true)
     */
    private $llavePropietaria;

    /**
     * @var boolean
     *
     * @ORM\Column(name="entidad_compartida", type="boolean", nullable=false)
     */
    private $entidadCompartida;

    /**
     * @var string
     *
     * @ORM\Column(name="llave_compartida", type="string", length=255, nullable=false)
     */
    private $llaveCompartida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="asignado_por", type="integer", nullable=false)
     */
    private $asignadoPor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vigencia_inicial", type="datetime", nullable=false)
     */
    private $vigenciaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vigencia_final", type="datetime", nullable=false)
     */
    private $vigenciaFinal;



    /**
     * Get idpermisoFuncionario
     *
     * @return integer
     */
    public function getIdpermisoFuncionario()
    {
        return $this->idpermisoFuncionario;
    }

    /**
     * Set entidadPropietaria
     *
     * @param boolean $entidadPropietaria
     *
     * @return PermisoFuncionario
     */
    public function setEntidadPropietaria($entidadPropietaria)
    {
        $this->entidadPropietaria = $entidadPropietaria;

        return $this;
    }

    /**
     * Get entidadPropietaria
     *
     * @return boolean
     */
    public function getEntidadPropietaria()
    {
        return $this->entidadPropietaria;
    }

    /**
     * Set llavePropietaria
     *
     * @param integer $llavePropietaria
     *
     * @return PermisoFuncionario
     */
    public function setLlavePropietaria($llavePropietaria)
    {
        $this->llavePropietaria = $llavePropietaria;

        return $this;
    }

    /**
     * Get llavePropietaria
     *
     * @return integer
     */
    public function getLlavePropietaria()
    {
        return $this->llavePropietaria;
    }

    /**
     * Set entidadCompartida
     *
     * @param boolean $entidadCompartida
     *
     * @return PermisoFuncionario
     */
    public function setEntidadCompartida($entidadCompartida)
    {
        $this->entidadCompartida = $entidadCompartida;

        return $this;
    }

    /**
     * Get entidadCompartida
     *
     * @return boolean
     */
    public function getEntidadCompartida()
    {
        return $this->entidadCompartida;
    }

    /**
     * Set llaveCompartida
     *
     * @param string $llaveCompartida
     *
     * @return PermisoFuncionario
     */
    public function setLlaveCompartida($llaveCompartida)
    {
        $this->llaveCompartida = $llaveCompartida;

        return $this;
    }

    /**
     * Get llaveCompartida
     *
     * @return string
     */
    public function getLlaveCompartida()
    {
        return $this->llaveCompartida;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return PermisoFuncionario
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set asignadoPor
     *
     * @param integer $asignadoPor
     *
     * @return PermisoFuncionario
     */
    public function setAsignadoPor($asignadoPor)
    {
        $this->asignadoPor = $asignadoPor;

        return $this;
    }

    /**
     * Get asignadoPor
     *
     * @return integer
     */
    public function getAsignadoPor()
    {
        return $this->asignadoPor;
    }

    /**
     * Set vigenciaInicial
     *
     * @param \DateTime $vigenciaInicial
     *
     * @return PermisoFuncionario
     */
    public function setVigenciaInicial($vigenciaInicial)
    {
        $this->vigenciaInicial = $vigenciaInicial;

        return $this;
    }

    /**
     * Get vigenciaInicial
     *
     * @return \DateTime
     */
    public function getVigenciaInicial()
    {
        return $this->vigenciaInicial;
    }

    /**
     * Set vigenciaFinal
     *
     * @param \DateTime $vigenciaFinal
     *
     * @return PermisoFuncionario
     */
    public function setVigenciaFinal($vigenciaFinal)
    {
        $this->vigenciaFinal = $vigenciaFinal;

        return $this;
    }

    /**
     * Get vigenciaFinal
     *
     * @return \DateTime
     */
    public function getVigenciaFinal()
    {
        return $this->vigenciaFinal;
    }
}
