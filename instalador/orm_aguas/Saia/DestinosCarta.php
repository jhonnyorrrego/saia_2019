<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DestinosCarta
 *
 * @ORM\Table(name="destinos_carta", indexes={@ORM\Index(name="i_destinos_car_iddatos_ejec", columns={"iddatos_ejecutor"}), @ORM\Index(name="i_destinos_carta_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class DestinosCarta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddestinos_carta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="DESTINOS_CARTA_IDDESTINOS_CART", allocationSize=1, initialValue=1)
     */
    private $iddestinosCarta;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddatos_ejecutor", type="integer", nullable=false)
     */
    private $iddatosEjecutor;


}

