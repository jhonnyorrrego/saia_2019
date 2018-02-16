<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaInclude
 *
 * @ORM\Table(name="pantalla_include", indexes={@ORM\Index(name="i_pant_include_pantalla", columns={"pantalla_idpantalla"}), @ORM\Index(name="i_pant_include_pantalla_lib1", columns={"fk_idpantalla_libreria"})})
 * @ORM\Entity
 */
class PantallaInclude
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_include", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaInclude;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="lugar_incluir", type="string", length=255, nullable=true)
     */
    private $lugarIncluir = 'footer';

    /**
     * @var string
     *
     * @ORM\Column(name="acciones_include", type="string", length=255, nullable=true)
     */
    private $accionesInclude = 'a,e,m';

    /**
     * @var integer
     *
     * @ORM\Column(name="pantalla_idpantalla", type="integer", nullable=false)
     */
    private $pantallaIdpantalla;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla_libreria", type="integer", nullable=false)
     */
    private $fkIdpantallaLibreria;



    /**
     * Get idpantallaInclude
     *
     * @return integer
     */
    public function getIdpantallaInclude()
    {
        return $this->idpantallaInclude;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return PantallaInclude
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
     * Set lugarIncluir
     *
     * @param string $lugarIncluir
     *
     * @return PantallaInclude
     */
    public function setLugarIncluir($lugarIncluir)
    {
        $this->lugarIncluir = $lugarIncluir;

        return $this;
    }

    /**
     * Get lugarIncluir
     *
     * @return string
     */
    public function getLugarIncluir()
    {
        return $this->lugarIncluir;
    }

    /**
     * Set accionesInclude
     *
     * @param string $accionesInclude
     *
     * @return PantallaInclude
     */
    public function setAccionesInclude($accionesInclude)
    {
        $this->accionesInclude = $accionesInclude;

        return $this;
    }

    /**
     * Get accionesInclude
     *
     * @return string
     */
    public function getAccionesInclude()
    {
        return $this->accionesInclude;
    }

    /**
     * Set pantallaIdpantalla
     *
     * @param integer $pantallaIdpantalla
     *
     * @return PantallaInclude
     */
    public function setPantallaIdpantalla($pantallaIdpantalla)
    {
        $this->pantallaIdpantalla = $pantallaIdpantalla;

        return $this;
    }

    /**
     * Get pantallaIdpantalla
     *
     * @return integer
     */
    public function getPantallaIdpantalla()
    {
        return $this->pantallaIdpantalla;
    }

    /**
     * Set fkIdpantallaLibreria
     *
     * @param integer $fkIdpantallaLibreria
     *
     * @return PantallaInclude
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
}
