<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contador
 *
 * @ORM\Table(name="contador", indexes={@ORM\Index(name="i_contador_nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Contador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcontador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\SequenceGenerator(sequenceName="CONTADOR_IDCONTADOR_seq", allocationSize=1, initialValue=1)
     */
    private $idcontador;

    /**
     * @var integer
     *
     * @ORM\Column(name="consecutivo", type="integer", nullable=false)
     */
    private $consecutivo = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="reiniciar_cambio_anio", type="integer", nullable=false)
     */
    private $reiniciarCambioAnio = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta_contador", type="string", length=255, nullable=true)
     */
    private $etiquetaContador;

    /**
     * @var string
     *
     * @ORM\Column(name="post", type="string", length=255, nullable=true)
     */
    private $post;


}
