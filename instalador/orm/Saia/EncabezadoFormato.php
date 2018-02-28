<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * EncabezadoFormato
 *
 * @ORM\Table(name="encabezado_formato")
 * @ORM\Entity
 */
class EncabezadoFormato
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idencabezado_formato", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idencabezadoFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="contenido", type="text", length=65535, nullable=false)
     */
    private $contenido;

    /**
     * @var string
     *
     * @ORM\Column(name="etiqueta", type="string", length=255, nullable=true)
     */
    private $etiqueta;



    /**
     * Get idencabezadoFormato
     *
     * @return integer
     */
    public function getIdencabezadoFormato()
    {
        return $this->idencabezadoFormato;
    }

    /**
     * Set contenido
     *
     * @param string $contenido
     *
     * @return EncabezadoFormato
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
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return EncabezadoFormato
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
}
