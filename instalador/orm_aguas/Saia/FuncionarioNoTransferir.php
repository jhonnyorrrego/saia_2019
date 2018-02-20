<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionarioNoTransferir
 *
 * @ORM\Table(name="FUNCIONARIO_NO_TRANSFERIR")
 * @ORM\Entity
 */
class FuncionarioNoTransferir
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFUNCIONARIO_NO_TRANSFERIR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONARIO_NO_TRANSFERIR_IDFU", allocationSize=1, initialValue=1)
     */
    private $idfuncionarioNoTransferir;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_RESTRINGIR", type="integer", nullable=false)
     */
    private $funcionarioRestringir;


}

