<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PasoEnlace
 *
 * @ORM\Table(name="paso_enlace", indexes={@ORM\Index(name="i_paso_enlace_idconector", columns={"idconector"})})
 * @ORM\Entity
 */
class PasoEnlace
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpaso_enlace", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpasoEnlace;

    /**
     * @var string
     *
     * @ORM\Column(name="origen", type="string", length=255, nullable=true)
     */
    private $origen;

    /**
     * @var integer
     *
     * @ORM\Column(name="destino", type="integer", nullable=true)
     */
    private $destino;

    /**
     * @var integer
     *
     * @ORM\Column(name="diagram_iddiagram", type="integer", nullable=false)
     */
    private $diagramIddiagram;

    /**
     * @var string
     *
     * @ORM\Column(name="idconector", type="string", length=255, nullable=false)
     */
    private $idconector;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_origen", type="string", length=255, nullable=true)
     */
    private $tipoOrigen;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_destino", type="string", length=255, nullable=true)
     */
    private $tipoDestino;


}
