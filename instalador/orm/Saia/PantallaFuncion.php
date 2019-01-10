<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncion
 *
 * @ORM\Table(name="pantalla_funcion")
 * @ORM\Entity
 */
class PantallaFuncion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_funcion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpantallaFuncion;

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
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla_libreria", type="integer", nullable=false)
     */
    private $fkIdpantallaLibreria;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_funcion", type="string", length=50, nullable=false)
     */
    private $tipoFuncion;

    /**
     * @var string
     *
     * @ORM\Column(name="ayuda", type="text", length=65535, nullable=true)
     */
    private $ayuda;



    /**
     * Get idpantallaFuncion
     *
     * @return integer
     */
    public function getIdpantallaFuncion()
    {
        return $this->idpantallaFuncion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PantallaFuncion
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
     * @return PantallaFuncion
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
     * Set fkIdpantallaLibreria
     *
     * @param integer $fkIdpantallaLibreria
     *
     * @return PantallaFuncion
     */
    public function setFkIdpantallaLibreria($fkIdpantallaLibreria)
    {
        $this->fkIdpantallaLibreria = $fkIdpantallaLibreria;

        return $this;
    }

    /**
     * Get fkIdpantallaLibreria
     *
     * @return integer
     */
    public function getFkIdpantallaLibreria()
    {
        return $this->fkIdpantallaLibreria;
    }

    /**
     * Set tipoFuncion
     *
     * @param string $tipoFuncion
     *
     * @return PantallaFuncion
     */
    public function setTipoFuncion($tipoFuncion)
    {
        $this->tipoFuncion = $tipoFuncion;

        return $this;
    }

    /**
     * Get tipoFuncion
     *
     * @return string
     */
    public function getTipoFuncion()
    {
        return $this->tipoFuncion;
    }

    /**
     * Set ayuda
     *
     * @param string $ayuda
     *
     * @return PantallaFuncion
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
}
