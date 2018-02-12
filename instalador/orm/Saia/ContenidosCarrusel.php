<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * ContenidosCarrusel
 *
 * @ORM\Table(name="contenidos_carrusel")
 * @ORM\Entity
 */
class ContenidosCarrusel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcontenidos_carrusel", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idcontenidosCarrusel;

    /**
     * @var integer
     *
     * @ORM\Column(name="carrusel_idcarrusel", type="integer", nullable=false)
     */
    private $carruselIdcarrusel;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden = '0';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_inicio", type="date", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_fin", type="date", nullable=false)
     */
    private $fechaFin;

    /**
     * @var string
     *
     * @ORM\Column(name="preview", type="text", length=65535, nullable=false)
     */
    private $preview;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="miniatura", type="string", length=255, nullable=true)
     */
    private $miniatura;

    /**
     * @var string
     *
     * @ORM\Column(name="align", type="string", length=20, nullable=true)
     */
    private $align = 'left';



    /**
     * Get idcontenidosCarrusel
     *
     * @return integer
     */
    public function getIdcontenidosCarrusel()
    {
        return $this->idcontenidosCarrusel;
    }

    /**
     * Set carruselIdcarrusel
     *
     * @param integer $carruselIdcarrusel
     *
     * @return ContenidosCarrusel
     */
    public function setCarruselIdcarrusel($carruselIdcarrusel)
    {
        $this->carruselIdcarrusel = $carruselIdcarrusel;

        return $this;
    }

    /**
     * Get carruselIdcarrusel
     *
     * @return integer
     */
    public function getCarruselIdcarrusel()
    {
        return $this->carruselIdcarrusel;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return ContenidosCarrusel
     */
    public function setContenido($contenido)
    {
        $this->contenido = $contenido;

        return $this;
    }

    /**
     * Get contenido
     *
     * @return string
     */
    public function getContenido()
    {
        return $this->contenido;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return ContenidosCarrusel
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return ContenidosCarrusel
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;

        return $this;
    }

    /**
     * Get orden
     *
     * @return integer
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     *
     * @return ContenidosCarrusel
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;

        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     *
     * @return ContenidosCarrusel
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;

        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set preview
     *
     * @param string $preview
     *
     * @return ContenidosCarrusel
     */
    public function setPreview($preview)
    {
        $this->preview = $preview;

        return $this;
    }

    /**
     * Get preview
     *
     * @return string
     */
    public function getPreview()
    {
        return $this->preview;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return ContenidosCarrusel
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
     * Set miniatura
     *
     * @param string $miniatura
     *
     * @return ContenidosCarrusel
     */
    public function setMiniatura($miniatura)
    {
        $this->miniatura = $miniatura;

        return $this;
    }

    /**
     * Get miniatura
     *
     * @return string
     */
    public function getMiniatura()
    {
        return $this->miniatura;
    }

    /**
     * Set align
     *
     * @param string $align
     *
     * @return ContenidosCarrusel
     */
    public function setAlign($align)
    {
        $this->align = $align;

        return $this;
    }

    /**
     * Get align
     *
     * @return string
     */
    public function getAlign()
    {
        return $this->align;
    }
}
