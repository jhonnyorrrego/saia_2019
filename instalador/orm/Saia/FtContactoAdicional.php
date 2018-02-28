<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtContactoAdicional
 *
 * @ORM\Table(name="ft_contacto_adicional", indexes={@ORM\Index(name="i_contacto_adicional_readh", columns={"ft_readh"})})
 * @ORM\Entity
 */
class FtContactoAdicional
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_contacto_adicional", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftContactoAdicional;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_readh", type="integer", nullable=false)
     */
    private $ftReadh;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="identificacion", type="integer", nullable=false)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;



    /**
     * Get idftContactoAdicional
     *
     * @return integer
     */
    public function getIdftContactoAdicional()
    {
        return $this->idftContactoAdicional;
    }

    /**
     * Set ftReadh
     *
     * @param integer $ftReadh
     *
     * @return FtContactoAdicional
     */
    public function setFtReadh($ftReadh)
    {
        $this->ftReadh = $ftReadh;

        return $this;
    }

    /**
     * Get ftReadh
     *
     * @return integer
     */
    public function getFtReadh()
    {
        return $this->ftReadh;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtContactoAdicional
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
     * Set identificacion
     *
     * @param integer $identificacion
     *
     * @return FtContactoAdicional
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return integer
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return FtContactoAdicional
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return FtContactoAdicional
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }
}
