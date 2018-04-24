<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Permiso
 *
 * @ORM\Table(name="permiso")
 * @ORM\Entity
 */
class Permiso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpermiso;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="accion", type="integer", nullable=true)
     */
    private $accion;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_propio", type="string", length=15, nullable=true)
     */
    private $caracteristicaPropio;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_grupo", type="string", length=15, nullable=true)
     */
    private $caracteristicaGrupo;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_total", type="string", length=15, nullable=true)
     */
    private $caracteristicaTotal;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tipo", type="boolean", nullable=false)
     */
    private $tipo = '1';


}

