<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Municipio
 *
 * @ORM\Table(name="municipio")
 * @ORM\Entity
 */
class Municipio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idmunicipio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idmunicipio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre = '';

    /**
     * @var integer
     *
     * @ORM\Column(name="departamento_iddepartamento", type="integer", nullable=false)
     */
    private $departamentoIddepartamento = '0';



    /**
     * Get idmunicipio
     *
     * @return integer
     */
    public function getIdmunicipio()
    {
        return $this->idmunicipio;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Municipio
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
     * Set departamentoIddepartamento
     *
     * @param integer $departamentoIddepartamento
     *
     * @return Municipio
     */
    public function setDepartamentoIddepartamento($departamentoIddepartamento)
    {
        $this->departamentoIddepartamento = $departamentoIddepartamento;

        return $this;
    }

    /**
     * Get departamentoIddepartamento
     *
     * @return integer
     */
    public function getDepartamentoIddepartamento()
    {
        return $this->departamentoIddepartamento;
    }
}
