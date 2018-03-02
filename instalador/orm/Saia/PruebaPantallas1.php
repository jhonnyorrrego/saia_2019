<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PruebaPantallas1
 *
 * @ORM\Table(name="prueba_pantallas1")
 * @ORM\Entity
 */
class PruebaPantallas1
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idprueba_pantallas1", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpruebaPantallas1;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido", type="string", length=255, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="e_mail", type="string", length=255, nullable=false)
     */
    private $eMail;



    /**
     * Get idpruebaPantallas1
     *
     * @return integer
     */
    public function getIdpruebaPantallas1()
    {
        return $this->idpruebaPantallas1;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PruebaPantallas1
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
     * Set apellido
     *
     * @param string $apellido
     *
     * @return PruebaPantallas1
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set eMail
     *
     * @param string $eMail
     *
     * @return PruebaPantallas1
     */
    public function setEMail($eMail)
    {
        $this->eMail = $eMail;

        return $this;
    }

    /**
     * Get eMail
     *
     * @return string
     */
    public function getEMail()
    {
        return $this->eMail;
    }
}
