<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permiso
 *
 * @ORM\Table(name="PERMISO")
 * @ORM\Entity
 */
class Permiso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERMISO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERMISO_IDPERMISO_seq", allocationSize=1, initialValue=1)
     */
    private $idpermiso;

    /**
     * @var integer
     *
     * @ORM\Column(name="FUNCIONARIO_IDFUNCIONARIO", type="integer", nullable=true)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="ACCION", type="string", length=50, nullable=true)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=true)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CARACTERISTICA_PROPIO", type="string", length=15, nullable=true)
     */
    private $caracteristicaPropio;

    /**
     * @var string
     *
     * @ORM\Column(name="CARACTERISTICA_GRUPO", type="string", length=15, nullable=true)
     */
    private $caracteristicaGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="CARACTERISTICA_TOTAL", type="string", length=15, nullable=true)
     */
    private $caracteristicaTotal;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO", type="string", length=1, nullable=true)
     */
    private $tipo = '1';


}
