<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormaPagoPrevio
 *
 * @ORM\Table(name="FORMA_PAGO_PREVIO")
 * @ORM\Entity
 */
class FormaPagoPrevio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDFORMA_PAGO_PREVIO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="FORMA_PAGO_PREVIO_IDFORMA_PAGO", allocationSize=1, initialValue=1)
     */
    private $idformaPagoPrevio;

    /**
     * @var integer
     *
     * @ORM\Column(name="SCDP_IDSCDP", type="integer", nullable=false)
     */
    private $scdpIdscdp;

    /**
     * @var integer
     *
     * @ORM\Column(name="FECHA_PAGO_PREVIO", type="integer", nullable=false)
     */
    private $fechaPagoPrevio;

    /**
     * @var integer
     *
     * @ORM\Column(name="VALOR", type="integer", nullable=false)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="PORCENTAJE", type="integer", nullable=false)
     */
    private $porcentaje;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUBRO_IDRUBRO", type="integer", nullable=true)
     */
    private $rubroIdrubro;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="VIGENCIA", type="integer", nullable=false)
     */
    private $vigencia;


}

