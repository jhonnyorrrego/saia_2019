<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="departamento")
 * @ORM\Entity
 */
class Departamento
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddepartamento", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $iddepartamento;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="pais_idpais", type="integer", nullable=false)
     */
    private $paisIdpais = '1';



    /**
     * Get iddepartamento
     *
     * @return integer
     */
    public function getIddepartamento()
    {
        return $this->iddepartamento;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Departamento
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
     * Set paisIdpais
     *
     * @param integer $paisIdpais
     *
     * @return Departamento
     */
    public function setPaisIdpais($paisIdpais)
    {
        $this->paisIdpais = $paisIdpais;

        return $this;
    }

    /**
     * Get paisIdpais
     *
     * @return integer
     */
    public function getPaisIdpais()
    {
        return $this->paisIdpais;
    }
}
