<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoFormato
 *
 * @ORM\Table(name="permiso_formato")
 * @ORM\Entity
 */
class PermisoFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpermisoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=false)
     */
    private $formatoIdformato = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="idpropietario", type="integer", nullable=false)
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
