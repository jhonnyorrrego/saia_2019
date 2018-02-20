<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionarioValidacion
 *
 * @ORM\Table(name="FUNCIONARIO_VALIDACION")
 * @ORM\Entity
 */
class FuncionarioValidacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONARIO_VALIDACION", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONARIO_VALIDACION_IDFUNCI", allocationSize=1, initialValue=1)
     */
    private $idfuncionarioValidacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=false)
     */
    private $tipo;


}
