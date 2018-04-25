<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtItemFacturas
 *
 * @ORM\Table(name="ft_item_facturas")
 * @ORM\Entity
 */
class FtItemFacturas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_item_facturas", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftItemFacturas;

    /**
     * @var string
     *
     * @ORM\Column(name="clasificacion_fact", type="string", length=255, nullable=false)
     */
    private $clasificacionFact;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_programada", type="date", nullable=false)
     */
    private $fechaProgramada;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_radicacion_facturas", type="integer", nullable=false)
     */
    private $ftRadicacionFacturas;

    /**
     * @var string
     *
     * @ORM\Column(name="no_convenio", type="string", length=255, nullable=true)
     */
    private $noConvenio;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_orden", type="string", length=255, nullable=false)
     */
    private $numeroOrden;

    /**
     * @var integer
     *
     * @ORM\Column(name="pago_desde", type="integer", nullable=false)
     */
    private $pagoDesde;

    /**
     * @var string
     *
     * @ORM\Column(name="posterior_adicionar", type="string", length=255, nullable=false)
     */
    private $posteriorAdicionar = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="prioridad", type="string", length=255, nullable=true)
     */
    private $prioridad;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '995';

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_factura", type="integer", nullable=false)
     */
    private $valorFactura;

    /**
     * @var integer
     *
     * @ORM\Column(name="transferido", type="integer", nullable=true)
     */
    private $transferido = '2';


}

