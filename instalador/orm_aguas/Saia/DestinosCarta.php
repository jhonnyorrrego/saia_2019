<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * DestinosCarta
 *
 * @ORM\Table(name="DESTINOS_CARTA", indexes={@ORM\Index(name="i_destinos_car_iddatos_ejec", columns={"IDDATOS_EJECUTOR"}), @ORM\Index(name="i_destinos_carta_doc", columns={"DOCUMENTO_IDDOCUMENTO"})})
 * @ORM\Entity
 */
class DestinosCarta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDDESTINOS_CARTA", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="DESTINOS_CARTA_IDDESTINOS_CART", allocationSize=1, initialValue=1)
     */
    private $iddestinosCarta;

    /**
     * @var integer
     *
     * @ORM\Column(name="DOCUMENTO_IDDOCUMENTO", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="IDDATOS_EJECUTOR", type="integer", nullable=false)
     */
    private $iddatosEjecutor;


}

