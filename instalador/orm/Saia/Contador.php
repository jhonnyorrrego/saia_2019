<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contador
 *
 * @ORM\Table(name="contador")
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



    /**
     * Get idcontador
     *
     * @return integer
     */
    public function getIdcontador()
    {
        return $this->idcontador;
    }

    /**
     * Set consecutivo
     *
     * @param integer $consecutivo
     *
     * @return Contador
     */
    public function setConsecutivo($consecutivo)
    {
        $this->consecutivo = $consecutivo;

        return $this;
    }

    /**
     * Get consecutivo
     *
     * @return integer
     */
    public function getConsecutivo()
    {
        return $this->consecutivo;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Contador
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
     * Set reiniciarCambioAnio
     *
     * @param integer $reiniciarCambioAnio
     *
     * @return Contador
     */
    public function setReiniciarCambioAnio($reiniciarCambioAnio)
    {
        $this->reiniciarCambioAnio = $reiniciarCambioAnio;

        return $this;
    }

    /**
     * Get reiniciarCambioAnio
     *
     * @return integer
     */
    public function getReiniciarCambioAnio()
    {
        return $this->reiniciarCambioAnio;
    }

    /**
     * Set etiquetaContador
     *
     * @param string $etiquetaContador
     *
     * @return Contador
     */
    public function setEtiquetaContador($etiquetaContador)
    {
        $this->etiquetaContador = $etiquetaContador;

        return $this;
    }

    /**
     * Get etiquetaContador
     *
     * @return string
     */
    public function getEtiquetaContador()
    {
        return $this->etiquetaContador;
    }

    /**
     * Set post
     *
     * @param string $post
     *
     * @return Contador
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return string
     */
    public function getPost()
    {
        return $this->post;
    }
}
