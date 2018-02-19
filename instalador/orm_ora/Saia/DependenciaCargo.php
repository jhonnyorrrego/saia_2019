<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DependenciaCargo
 *
 * @ORM\Table(name="DEPENDENCIA_CARGO", indexes={@ORM\Index(name="dependencia_cargo_cargo", columns={"CARGO_IDCARGO"}), @ORM\Index(name="dependencia_cargo_dependencia", columns={"DEPENDENCIA_IDDEPENDENCIA"}), @ORM\Index(name="dependencia_cargo_funcionario", columns={"FUNCIONARIO_IDFUNCIONARIO"}), @ORM\Index(name="dependencia_cargo_fecha_f", columns={"FECHA_FINAL"}), @ORM\Index(name="dependencia_cargo_fecha_i", columns={"FECHA_INICIAL"})})
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
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA_IDDEPENDENCIA", type="integer", nullable=true)
     */
    private $dependenciaIddependencia = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="CARGO_IDCARGO", type="integer", nullable=true)
     */
    private $cargoIdcargo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=true)
     */
    private $fechaInicial = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=true)
     */
    private $fechaFinal = 'TO_DATE(\'2009-01-01\',\'yyyy-mm-dd\')';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INGRESO", type="date", nullable=true)
     */
    private $fechaIngreso = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=1, nullable=true)
     */
    private $tipo = '0';


}
