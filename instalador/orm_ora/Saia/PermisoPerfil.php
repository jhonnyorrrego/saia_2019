<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoPerfil
 *
 * @ORM\Table(name="permiso_perfil")
 * @ORM\Entity
 */
class PermisoPerfil
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_perfil", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpermisoPerfil;

    /**
     * @var integer
     *
     * @ORM\Column(name="modulo_idmodulo", type="integer", nullable=false)
     */
    private $moduloIdmodulo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="perfil_idperfil", type="integer", nullable=false)
     */
    private $perfilIdperfil = '0';

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


}
