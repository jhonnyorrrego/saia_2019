<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoAnexo
 *
 * @ORM\Table(name="PERMISO_ANEXO", indexes={@ORM\Index(name="i_permiso_anex_idpropietari", columns={"IDPROPIETARIO"})})
 * @ORM\Entity
 */
class PermisoAnexo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERMISO_ANEXO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERMISO_ANEXO_IDPERMISO_ANEXO_", allocationSize=1, initialValue=1)
     */
    private $idpermisoAnexo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ANEXOS_IDANEXOS", type="integer", nullable=false)
     */
    private $anexosIdanexos = '0';

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
