<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pagina
 *
 * @ORM\Table(name="pagina")
 * @ORM\Entity
 */
class Pagina
{
    /**
     * @var integer
     *
     * @ORM\Column(name="consecutivo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $consecutivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_documento", type="integer", nullable=false)
     */
    private $idDocumento = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", length=600, nullable=true)
     */
    private $imagen;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagina", type="integer", nullable=false)
     */
    private $pagina = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=600, nullable=true)
     */
    private $ruta;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pagina", type="datetime", nullable=true)
     */
    private $fechaPagina;

    /**
     * @var string
     *
     * @ORM\Column(name="hash_file", type="string", length=255, nullable=true)
     */
    private $hashFile;



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
     * Set idDocumento
     *
     * @param integer $idDocumento
     *
     * @return Pagina
     */
    public function setIdDocumento($idDocumento)
    {
        $this->idDocumento = $idDocumento;

        return $this;
    }

    /**
     * Get idDocumento
     *
     * @return integer
     */
    public function getIdDocumento()
    {
        return $this->idDocumento;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Pagina
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
     * Set pagina
     *
     * @param integer $pagina
     *
     * @return Pagina
     */
    public function setPagina($pagina)
    {
        $this->pagina = $pagina;

        return $this;
    }

    /**
     * Get pagina
     *
     * @return integer
     */
    public function getPagina()
    {
        return $this->pagina;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return Pagina
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
     * Set fechaPagina
     *
     * @param \DateTime $fechaPagina
     *
     * @return Pagina
     */
    public function setFechaPagina($fechaPagina)
    {
        $this->fechaPagina = $fechaPagina;

        return $this;
    }

    /**
     * Get fechaPagina
     *
     * @return \DateTime
     */
    public function getFechaPagina()
    {
        return $this->fechaPagina;
    }

    /**
     * Set hashFile
     *
     * @param string $hashFile
     *
     * @return Pagina
     */
    public function setHashFile($hashFile)
    {
        $this->hashFile = $hashFile;

        return $this;
    }

    /**
     * Get hashFile
     *
     * @return string
     */
    public function getHashFile()
    {
        return $this->hashFile;
    }
}
