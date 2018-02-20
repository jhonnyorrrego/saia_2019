<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnlaceNodo
 *
 * @ORM\Table(name="enlace_nodo")
 * @ORM\Entity
 */
class EnlaceNodo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idenlace_nodo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="ENLACE_NODO_IDENLACE_NODO_seq", allocationSize=1, initialValue=1)
     */
    private $idenlaceNodo;

    /**
     * @var integer
     *
     * @ORM\Column(name="origen", type="integer", nullable=false)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=false)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var integer
     *
     * @ORM\Column(name="ruta", type="integer", nullable=false)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_ruta", type="string", length=9, nullable=false)
     */
    private $tipoRuta;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado;

    /**
     * @var integer
     *
     * @ORM\Column(name="obligatorio", type="integer", nullable=true)
     */
    private $obligatorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="restrictivo", type="integer", nullable=true)
     */
    private $restrictivo;


}

