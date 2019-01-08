<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DependenciaCargo
 *
 * @ORM\Table(name="dependencia_cargo")
 * @ORM\Entity
 */
class DependenciaCargo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddependencia_cargo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
     * @var boolean
     *
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicial", type="datetime", nullable=false)
     */
    private $fechaInicial = '2006-12-31 21:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_final", type="datetime", nullable=false)
     */
    private $fechaFinal = '2010-12-31 21:00:00';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="datetime", nullable=false)
     */
    private $fechaIngreso = 'CURRENT_TIMESTAMP';

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="boolean", nullable=false)
     */
    private $tipo = '1';


}

