<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ListaNegraAcceso
 *
 * @ORM\Table(name="lista_negra_acceso", indexes={@ORM\Index(name="i_lista_negra__login", columns={"login"})})
 * @ORM\Entity
 */
class ListaNegraAcceso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idlista_negra_acceso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idlistaNegraAcceso;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, nullable=true)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="iplocal", type="string", length=255, nullable=true)
     */
    private $iplocal;

    /**
     * @var string
     *
     * @ORM\Column(name="ipremota", type="string", length=255, nullable=true)
     */
    private $ipremota;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;


}
