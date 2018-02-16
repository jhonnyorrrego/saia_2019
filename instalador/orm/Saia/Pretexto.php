<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pretexto
 *
 * @ORM\Table(name="pretexto")
 * @ORM\Entity
 */
class Pretexto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpretexto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpretexto;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", nullable=true)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="string", length=1000, nullable=true)
     */
    private $ayuda;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=255, nullable=true)
     */
    private $imagen;

    /**
     * @var string
     *
     * @ORM\Column(name="asunto", type="string", length=255, nullable=true)
     */
    private $asunto;



    /**
     * Get idpretexto
     *
     * @return integer
     */
    public function getIdpretexto()
    {
        return $this->idpretexto;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return Pretexto
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
     * Set ayuda
     *
     * @param string $ayuda
     *
     * @return Pretexto
     */
    public function setAyuda($ayuda)
    {
        $this->ayuda = $ayuda;

        return $this;
    }

    /**
     * Get ayuda
     *
     * @return string
     */
    public function getAyuda()
    {
        return $this->ayuda;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Pretexto
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
     * Set asunto
     *
     * @param string $asunto
     *
     * @return Pretexto
     */
    public function setAsunto($asunto)
    {
        $this->asunto = $asunto;

        return $this;
    }

    /**
     * Get asunto
     *
     * @return string
     */
    public function getAsunto()
    {
        return $this->asunto;
    }
}
