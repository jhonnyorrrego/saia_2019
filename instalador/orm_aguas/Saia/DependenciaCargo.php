<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DependenciaCargo
 *
 * @ORM\Table(name="dependencia_cargo", indexes={@ORM\Index(name="i_dependencia__dependencia_", columns={"dependencia_iddependencia"}), @ORM\Index(name="i_dependencia__funcionario_", columns={"funcionario_idfuncionario"}), @ORM\Index(name="i_dependencia__cargo_idcarg", columns={"cargo_idcargo"})})
 * @ORM\Entity
 */
class DependenciaCargo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddependencia_cargo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddependenciaCargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia_iddependencia", type="integer", nullable=false)
     */
    private $dependenciaIddependencia = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="cargo_idcargo", type="integer", nullable=false)
     */
    private $cargoIdcargo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="date", nullable=false)
     */
    private $fechaInicial = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal = 'SYSDATE';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=false)
     */
    private $fechaIngreso = 'SYSDATE';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo = '1';


}
