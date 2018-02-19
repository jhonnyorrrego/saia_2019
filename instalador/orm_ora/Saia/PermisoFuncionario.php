<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoFuncionario
 *
 * @ORM\Table(name="PERMISO_FUNCIONARIO")
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
     * @ORM\Column(name="ENTIDAD_PROPIETARIA", type="integer", nullable=true)
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
     * @ORM\Column(name="ENTIDAD_COMPARTIDA", type="integer", nullable=true)
     */
    private $entidadCompartida;

    /**
     * @var string
     *
     * @ORM\Column(name="LLAVE_COMPARTIDA", type="string", length=255, nullable=true)
     */
    private $llaveCompartida;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="ASIGNADO_POR", type="integer", nullable=true)
     */
    private $asignadoPor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="VIGENCIA_INICIAL", type="date", nullable=true)
     */
    private $vigenciaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="VIGENCIA_FINAL", type="date", nullable=true)
     */
    private $vigenciaFinal;


}

