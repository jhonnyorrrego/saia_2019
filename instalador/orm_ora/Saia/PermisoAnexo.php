<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoAnexo
 *
 * @ORM\Table(name="permiso_anexo", indexes={@ORM\Index(name="i_permiso_anex_idpropietari", columns={"idpropietario"})})
 * @ORM\Entity
 */
class PermisoAnexo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_anexo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpermisoAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="anexos_idanexos", type="integer", nullable=false)
     */
    private $anexosIdanexos = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idpropietario", type="integer", nullable=true)
     */
    private $idpropietario = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_propio", type="string", length=8, nullable=true)
     */
    private $caracteristicaPropio;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_dependencia", type="string", length=8, nullable=true)
     */
    private $caracteristicaDependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_cargo", type="string", length=8, nullable=true)
     */
    private $caracteristicaCargo;

    /**
     * @var string
     *
     * @ORM\Column(name="caracteristica_total", type="string", length=8, nullable=true)
     */
    private $caracteristicaTotal;


}
