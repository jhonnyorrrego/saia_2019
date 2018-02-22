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



    /**
     * Get idnoticiaIndex
     *
     * @return integer
     */
    public function getIdnoticiaIndex()
    {
        return $this->idnoticiaIndex;
    }

    /**
     * Set noticia
     *
     * @param string $noticia
     *
     * @return NoticiaIndex
     */
    public function setNoticia($noticia)
    {
        $this->noticia = $noticia;

        return $this;
    }

    /**
     * Get noticia
     *
     * @return string
     */
    public function getNoticia()
    {
        return $this->noticia;
    }

    /**
     * Set previo
     *
     * @param string $previo
     *
     * @return NoticiaIndex
     */
    public function setPrevio($previo)
    {
        $this->previo = $previo;

        return $this;
    }

    /**
     * Get previo
     *
     * @return string
     */
    public function getPrevio()
    {
        return $this->previo;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return NoticiaIndex
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return NoticiaIndex
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return NoticiaIndex
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set subtitulo
     *
     * @param string $subtitulo
     *
     * @return NoticiaIndex
     */
    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;

        return $this;
    }

    /**
     * Get subtitulo
     *
     * @return string
     */
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return NoticiaIndex
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set mostrar
     *
     * @param integer $mostrar
     *
     * @return NoticiaIndex
     */
    public function setMostrar($mostrar)
    {
        $this->mostrar = $mostrar;

        return $this;
    }

    /**
     * Get mostrar
     *
     * @return integer
     */
    public function getMostrar()
    {
        return $this->mostrar;
    }
}
