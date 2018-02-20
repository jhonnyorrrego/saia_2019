<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * NoticiaIndex
 *
 * @ORM\Table(name="NOTICIA_INDEX", indexes={@ORM\Index(name="i_noticia_in_noticia_ctx", columns={"NOTICIA"})})
 * @ORM\Entity
 */
class NoticiaIndex
{
    /**
     * @var integer
     *
     * @ORM\Column(name="IDNOTICIA_INDEX", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="NOTICIA_INDEX_IDNOTICIA_INDEX_", allocationSize=1, initialValue=1)
     */
    private $idnoticiaIndex;

    /**
     * @var string
     *
     * @ORM\Column(name="NOTICIA", type="text", nullable=false)
     */
    private $noticia;

    /**
     * @var string
     *
     * @ORM\Column(name="PREVIO", type="string", length=255, nullable=false)
     */
    private $previo;

    /**
     * @var string
     *
     * @ORM\Column(name="IMAGEN", type="string", length=255, nullable=false)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="ESTADO", type="integer", nullable=false)
     */
    private $estado = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="TITULO", type="string", length=255, nullable=false)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="SUBTITULO", type="string", length=255, nullable=false)
     */
    private $subtitulo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="FECHA", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="MOSTRAR", type="integer", nullable=false)
     */
    private $mostrar = '0';


}
