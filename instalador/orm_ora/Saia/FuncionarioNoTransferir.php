<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionarioNoTransferir
 *
 * @ORM\Table(name="funcionario_no_transferir")
 * @ORM\Entity
 */
class FuncionarioNoTransferir
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfuncionario_no_transferir", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="FUNCIONARIO_NO_TRANSFERIR_IDFU", allocationSize=1, initialValue=1)
     */
    private $idfuncionarioNoTransferir;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_restringir", type="integer", nullable=false)
     */
    private $funcionarioRestringir;


}

