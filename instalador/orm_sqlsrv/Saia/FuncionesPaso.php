<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FuncionesPaso
 *
 * @ORM\Table(name="funciones_paso")
 * @ORM\Entity
 */
class FuncionesPaso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idfunciones_paso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idfuncionesPaso;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="parametros", type="string", length=255, nullable=true)
     */
    private $parametros;

    /**
     * @var string
     *
     * @ORM\Column(name="libreria", type="string", length=255, nullable=false)
     */
    private $libreria;



    /**
     * Get idfuncionesPaso
     *
     * @return integer
     */
    public function getIdfuncionesPaso()
    {
        return $this->idfuncionesPaso;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FuncionesPaso
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
     * Set parametros
     *
     * @param string $parametros
     *
     * @return FuncionesPaso
     */
    public function setParametros($parametros)
    {
        $this->parametros = $parametros;

        return $this;
    }

    /**
     * Get parametros
     *
     * @return string
     */
    public function getParametros()
    {
        return $this->parametros;
    }

    /**
     * Set libreria
     *
     * @param string $libreria
     *
     * @return FuncionesPaso
     */
    public function setLibreria($libreria)
    {
        $this->libreria = $libreria;

        return $this;
    }

    /**
     * Get libreria
     *
     * @return string
     */
    public function getLibreria()
    {
        return $this->libreria;
    }
}
