<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PermisoExpediente
 *
 * @ORM\Table(name="PERMISO_EXPEDIENTE")
 * @ORM\Entity
 */
class PermisoExpediente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDPERMISO_EXPEDIENTE", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="PERMISO_EXPEDIENTE_IDPERMISO_E", allocationSize=1, initialValue=1)
     */
    private $idpermisoExpediente;

    /**
     * @var integer
     *
     * @ORM\Column(name="EXPEDIENTE_IDEXPEDIENTE", type="integer", nullable=true)
     */
    private $expedienteIdexpediente = '0';

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

