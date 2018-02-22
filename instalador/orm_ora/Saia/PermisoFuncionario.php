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
     * @var integer
     *
     * @ORM\Column(name="entidad_propietaria", type="integer", nullable=false)
     */
    private $entidadPropietaria;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave_propietaria", type="integer", nullable=true)
     */
    private $llavePropietaria;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad_compartida", type="integer", nullable=false)
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
     * @ORM\Column(name="fecha", type="date", nullable=false)
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
     * @ORM\Column(name="vigencia_inicial", type="date", nullable=false)
     */
    private $vigenciaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="vigencia_final", type="date", nullable=false)
     */
    private $vigenciaFinal;


}
