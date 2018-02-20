<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * NoticiaIndex
 *
 * @ORM\Table(name="noticia_index")
 * @ORM\Entity
 */
class NoticiaIndex
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idnoticia_index", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idnoticiaIndex;

    /**
     * @var string
     *
     * @ORM\Column(name="noticia", type="text", nullable=false)
     */
    private $noticia;

    /**
     * @var string
     *
     * @ORM\Column(name="previo", type="string", length=255, nullable=false)
     */
    private $previo;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=false)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="subtitulo", type="string", length=255, nullable=false)
     */
    private $subtitulo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="mostrar", type="integer", nullable=false)
     */
    private $mostrar = '0';


}
