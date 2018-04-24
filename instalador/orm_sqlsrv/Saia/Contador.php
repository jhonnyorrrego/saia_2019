<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contador
 *
 * @ORM\Table(name="contador", uniqueConstraints={@ORM\UniqueConstraint(name="nombre", columns={"nombre"})})
 * @ORM\Entity
 */
class Contador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcontador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
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
    private $nombre = '';

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
