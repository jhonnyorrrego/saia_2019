<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoFormato
 *
 * @ORM\Table(name="PERMISO_FORMATO")
 * @ORM\Entity
 */
class PermisoFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERMISO_FORMATO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERMISO_FORMATO_IDPERMISO_FORM", allocationSize=1, initialValue=1)
     */
    private $idpermisoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="FORMATO_IDFORMATO", type="integer", nullable=true)
     */
    private $formatoIdformato = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="IDPROPIETARIO", type="integer", nullable=true)
     */
    private $idpropietario = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="CARACTERISTICA_PROPIO", type="string", length=8, nullable=true)
     */
    private $caracteristicaPropio;

    /**
     * @var string
     *
     * @ORM\Column(name="CARACTERISTICA_DEPENDENCIA", type="string", length=8, nullable=true)
     */
    private $caracteristicaDependencia;

    /**
     * @var string
     *
     * @ORM\Column(name="CARACTERISTICA_CARGO", type="string", length=8, nullable=true)
     */
    private $caracteristicaCargo;

    /**
     * @var string
     *
     * @ORM\Column(name="CARACTERISTICA_TOTAL", type="string", length=8, nullable=true)
     */
    private $caracteristicaTotal;


}

