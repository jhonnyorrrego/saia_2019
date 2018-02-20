<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoFuncionario
 *
 * @ORM\Table(name="PERMISO_FUNCIONARIO", indexes={@ORM\Index(name="i_permiso_func_asignado_por", columns={"ASIGNADO_POR"}), @ORM\Index(name="i_permiso_func_entidad_comp", columns={"ENTIDAD_COMPARTIDA"})})
 * @ORM\Entity
 */
class PermisoFuncionario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERMISO_FUNCIONARIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERMISO_FUNCIONARIO_IDPERMISO_", allocationSize=1, initialValue=1)
     */
    private $idpermisoFuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_PROPIETARIA", type="integer", nullable=false)
     */
    private $entidadPropietaria;

    /**
     * @var integer
     *
     * @ORM\Column(name="LLAVE_PROPIETARIA", type="integer", nullable=true)
     */
    private $llavePropietaria;

    /**
     * @var integer
     *
     * @ORM\Column(name="ENTIDAD_COMPARTIDA", type="integer", nullable=false)
     */
    private $entidadCompartida;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE_COMPARTIDA", type="string", length=255, nullable=false)
     */
    private $llaveCompartida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="ASIGNADO_POR", type="integer", nullable=false)
     */
    private $asignadoPor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="VIGENCIA_INICIAL", type="date", nullable=false)
     */
    private $vigenciaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="VIGENCIA_FINAL", type="date", nullable=false)
     */
    private $vigenciaFinal;


}
