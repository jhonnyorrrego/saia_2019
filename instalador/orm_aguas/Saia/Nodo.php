<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nodo
 *
 * @ORM\Table(name="NODO", indexes={@ORM\Index(name="i_nodo_estado_ctx", columns={"ESTADO"})})
 * @ORM\Entity
 */
class Nodo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDNODO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="NODO_IDNODO_seq", allocationSize=1, initialValue=1)
     */
    private $idnodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ETIQUETA", type="integer", nullable=false)
     */
    private $etiqueta = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="NODO", type="integer", nullable=false)
     */
    private $nodo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO_NODO", type="integer", nullable=false)
     */
    private $tipoNodo = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=true)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSX", type="integer", nullable=true)
     */
    private $posx;

    /**
     * @var integer
     *
     * @ORM\Column(name="POSY", type="integer", nullable=false)
     */
    private $posy = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha = 'SYSDATE';

    /**
     * @var string
     *
     * @ORM\Column(name="ESTADO", type="string", length=4000, nullable=false)
     */
    private $estado = 'INACTIVO';

    /**
     * @var integer
     *
     * @ORM\Column(name="TIPO", type="integer", nullable=false)
     */
    private $tipo = '1';


}

