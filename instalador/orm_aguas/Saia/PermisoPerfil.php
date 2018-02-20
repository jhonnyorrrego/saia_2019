<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoPerfil
 *
 * @ORM\Table(name="PERMISO_PERFIL")
 * @ORM\Entity
 */
class PermisoPerfil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERMISO_PERFIL", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERMISO_PERFIL_IDPERMISO_PERFI", allocationSize=1, initialValue=1)
     */
    private $idpermisoPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="MODULO_IDMODULO", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="PERFIL_IDPERFIL", type="integer", nullable=false)
     */
    private $perfilIdperfil = '0';

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


}
