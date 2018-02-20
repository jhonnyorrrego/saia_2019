<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnlaceNodo
 *
 * @ORM\Table(name="ENLACE_NODO")
 * @ORM\Entity
 */
class EnlaceNodo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDENLACE_NODO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="ENLACE_NODO_IDENLACE_NODO_seq", allocationSize=1, initialValue=1)
     */
    private $idenlaceNodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORIGEN", type="integer", nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="DESTINO", type="integer", nullable=false)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="ORDEN", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="RUTA", type="integer", nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="TIPO_RUTA", type="string", length=9, nullable=false)
     */
    private $tipoRuta;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="OBLIGATORIO", type="integer", nullable=true)
     */
    private $obligatorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="RESTRICTIVO", type="integer", nullable=true)
     */
    private $restrictivo;


}

