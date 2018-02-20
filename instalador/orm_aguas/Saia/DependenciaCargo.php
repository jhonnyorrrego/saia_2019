<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DependenciaCargo
 *
 * @ORM\Table(name="DEPENDENCIA_CARGO", indexes={@ORM\Index(name="i_dependencia__dependencia_", columns={"DEPENDENCIA_IDDEPENDENCIA"}), @ORM\Index(name="i_dependencia__funcionario_", columns={"FUNCIONARIO_IDFUNCIONARIO"}), @ORM\Index(name="i_dependencia__cargo_idcarg", columns={"CARGO_IDCARGO"})})
 * @ORM\Entity
 */
class DependenciaCargo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDEPENDENCIA_CARGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DEPENDENCIA_CARGO_IDDEPENDENCI", allocationSize=1, initialValue=1)
     */
    private $iddependenciaCargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA_IDDEPENDENCIA", type="integer", nullable=false)
     */
    private $dependenciaIddependencia = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="CARGO_IDCARGO", type="integer", nullable=false)
     */
    private $cargoIdcargo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=false)
     */
    private $fechaInicial = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=false)
     */
    private $fechaFinal = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INGRESO", type="date", nullable=false)
     */
    private $fechaIngreso = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=false)
     */
    private $tipo = '1';


}
