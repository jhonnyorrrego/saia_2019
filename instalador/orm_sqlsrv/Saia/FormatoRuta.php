<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FormatoRuta
 *
 * @ORM\Table(name="formato_ruta")
 * @ORM\Entity
 */
class FormatoRuta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idformato_ruta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idformatoRuta;

    /**
     * @var integer
     *
     * @ORM\Column(name="entidad", type="integer", nullable=true)
     */
    private $entidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="llave", type="integer", nullable=true)
     */
    private $llave;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma;

    /**
     * @var integer
     *
     * @ORM\Column(name="orden", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=255, nullable=true)
     */
    private $ruta;

    /**
     * @var string
     *
     * @ORM\Column(name="funcion", type="string", length=255, nullable=true)
     */
    private $funcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="formato_idformato", type="integer", nullable=false)
     */
    private $formatoIdformato;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_campo", type="integer", nullable=true)
     */
    private $tipoCampo = '1';



    /**
     * Get idformatoRuta
     *
     * @return integer
     */
    public function getIdformatoRuta()
    {
        return $this->idformatoRuta;
    }

    /**
     * Set entidad
     *
     * @param integer $entidad
     *
     * @return FormatoRuta
     */
    public function setEntidad($entidad)
    {
        $this->entidad = $entidad;

        return $this;
    }

    /**
     * Get entidad
     *
     * @return integer
     */
    public function getEntidad()
    {
        return $this->entidad;
    }

    /**
     * Set llave
     *
     * @param integer $llave
     *
     * @return FormatoRuta
     */
    public function setLlave($llave)
    {
        $this->llave = $llave;

        return $this;
    }

    /**
     * Get llave
     *
     * @return integer
     */
    public function getLlave()
    {
        return $this->llave;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FormatoRuta
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set orden
     *
     * @param integer $orden
     *
     * @return FormatoRuta
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
     * Set ruta
     *
     * @param string $ruta
     *
     * @return FormatoRuta
     */
    public function setRuta($ruta)
    {
        $this->ruta = $ruta;

        return $this;
    }

    /**
     * Get ruta
     *
     * @return string
     */
    public function getRuta()
    {
        return $this->ruta;
    }

    /**
     * Set funcion
     *
     * @param string $funcion
     *
     * @return FormatoRuta
     */
    public function setFuncion($funcion)
    {
        $this->funcion = $funcion;

        return $this;
    }

    /**
     * Get funcion
     *
     * @return string
     */
    public function getFuncion()
    {
        return $this->funcion;
    }

    /**
     * Set formatoIdformato
     *
     * @param integer $formatoIdformato
     *
     * @return FormatoRuta
     */
    public function setFormatoIdformato($formatoIdformato)
    {
        $this->formatoIdformato = $formatoIdformato;

        return $this;
    }

    /**
     * Get formatoIdformato
     *
     * @return integer
     */
    public function getFormatoIdformato()
    {
        return $this->formatoIdformato;
    }

    /**
     * Set tipoCampo
     *
     * @param integer $tipoCampo
     *
     * @return FormatoRuta
     */
    public function setTipoCampo($tipoCampo)
    {
        $this->tipoCampo = $tipoCampo;

        return $this;
    }

    /**
     * Get tipoCampo
     *
     * @return integer
     */
    public function getTipoCampo()
    {
        return $this->tipoCampo;
    }
}
