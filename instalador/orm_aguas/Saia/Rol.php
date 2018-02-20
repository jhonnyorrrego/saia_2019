<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rol
 *
 * @ORM\Table(name="ROL")
 * @ORM\Entity
 */
class Rol
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDEPENDENCIA_CARGO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ROL_IDDEPENDENCIA_CARGO_seq", allocationSize=1, initialValue=1)
     */
    private $iddependenciaCargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="DEPENDENCIA_IDDEPENDENCIA", type="integer", nullable=false)
     */
    private $dependenciaIddependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="CARGO_IDCARGO", type="integer", nullable=false)
     */
    private $cargoIdcargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INICIAL", type="date", nullable=false)
     */
    private $fechaInicial;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_FINAL", type="date", nullable=false)
     */
    private $fechaFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA_INGRESO", type="date", nullable=false)
     */
    private $fechaIngreso;

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=false)
     */
    private $tipo;


}

