<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contador
 *
 * @ORM\Table(name="CONTADOR", indexes={@ORM\Index(name="contador_consecutivo", columns={"CONSECUTIVO"}), @ORM\Index(name="contador_nombre", columns={"NOMBRE"})})
 * @ORM\Entity
 */
class Contador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDCONTADOR", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="CONTADOR_IDCONTADOR_seq", allocationSize=1, initialValue=1)
     */
    private $idcontador;

    /**
     * @var integer
     *
     * @ORM\Column(name="CONSECUTIVO", type="integer", nullable=true)
     */
    private $consecutivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="NOMBRE", type="string", length=100, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="ETIQUETA_CONTADOR", type="string", length=255, nullable=true)
     */
    private $etiquetaContador;

    /**
     * @var string
     *
     * @ORM\Column(name="REINICIAR_CAMBIO_ANIO", type="string", length=20, nullable=true)
     */
    private $reiniciarCambioAnio = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="POST", type="string", length=255, nullable=true)
     */
    private $post;


}
