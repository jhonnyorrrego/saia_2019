<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormaPagoPrevio
 *
 * @ORM\Table(name="forma_pago_previo")
 * @ORM\Entity
 */
class FormaPagoPrevio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idforma_pago_previo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="FORMA_PAGO_PREVIO_IDFORMA_PAGO", allocationSize=1, initialValue=1)
     */
    private $idformaPagoPrevio;

    /**
     * @var integer
     *
     * @ORM\Column(name="scdp_idscdp", type="integer", nullable=false)
     */
    private $scdpIdscdp;

    /**
     * @var integer
     *
     * @ORM\Column(name="fecha_pago_previo", type="integer", nullable=false)
     */
    private $fechaPagoPrevio;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor", type="integer", nullable=false)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="porcentaje", type="integer", nullable=false)
     */
    private $porcentaje;

    /**
     * @var integer
     *
     * @ORM\Column(name="rubro_idrubro", type="integer", nullable=true)
     */
    private $rubroIdrubro;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="vigencia", type="integer", nullable=false)
     */
    private $vigencia;


}

