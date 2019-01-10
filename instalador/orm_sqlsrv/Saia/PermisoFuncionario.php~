<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoFuncionario
 *
 * @ORM\Table(name="permiso_funcionario")
 * @ORM\Entity
 */
class PermisoFuncionario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_funcionario", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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


}

