<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="rol")
 * @ORM\Entity
 */
class Rol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddependencia_cargo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ROL_IDDEPENDENCIA_CARGO_seq", allocationSize=1, initialValue=1)
     */
    private $iddependenciaCargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia_iddependencia", type="integer", nullable=false)
     */
    private $dependenciaIddependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="cargo_idcargo", type="integer", nullable=false)
     */
    private $cargoIdcargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="date", nullable=false)
     */
    private $fechaFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=false)
     */
    private $fechaIngreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;


}

