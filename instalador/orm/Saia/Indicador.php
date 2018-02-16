<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicador
 *
 * @ORM\Table(name="indicador")
 * @ORM\Entity
 */
class Indicador
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idindicador", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idindicador;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta_formulario", type="string", length=255, nullable=false)
     */
    private $rutaFormulario;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=false)
     */
    private $etiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="librerias", type="text", length=65535, nullable=true)
     */
    private $librerias;



    /**
     * Get idindicador
     *
     * @return integer
     */
    public function getIdindicador()
    {
        return $this->idindicador;
    }

    /**
     * Set rutaFormulario
     *
     * @param string $rutaFormulario
     *
     * @return Indicador
     */
    public function setRutaFormulario($rutaFormulario)
    {
        $this->rutaFormulario = $rutaFormulario;

        return $this;
    }

    /**
     * Get rutaFormulario
     *
     * @return string
     */
    public function getRutaFormulario()
    {
        return $this->rutaFormulario;
    }

    /**
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return Indicador
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Indicador
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
     * Set librerias
     *
     * @param string $librerias
     *
     * @return Indicador
     */
    public function setLibrerias($librerias)
    {
        $this->librerias = $librerias;

        return $this;
    }

    /**
     * Get librerias
     *
     * @return string
     */
    public function getLibrerias()
    {
        return $this->librerias;
    }
}
