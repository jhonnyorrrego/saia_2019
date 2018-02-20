<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListaNegraAcceso
 *
 * @ORM\Table(name="LISTA_NEGRA_ACCESO", indexes={@ORM\Index(name="i_lista_negra__login", columns={"LOGIN"})})
 * @ORM\Entity
 */
class ListaNegraAcceso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDLISTA_NEGRA_ACCESO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="LISTA_NEGRA_ACCESO_IDLISTA_NEG", allocationSize=1, initialValue=1)
     */
    private $idlistaNegraAcceso;

    /**
     * @var string
     *
     * @ORM\Column(name="LOGIN", type="string", length=255, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="IPLOCAL", type="string", length=255, nullable=true)
     */
    private $iplocal;

    /**
     * @var string
     *
     * @ORM\Column(name="IPREMOTA", type="string", length=255, nullable=true)
     */
    private $ipremota;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=true)
     */
    private $estado;


}
