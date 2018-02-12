<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * MunicipioExterior
 *
 * @ORM\Table(name="municipio_exterior")
 * @ORM\Entity
 */
class MunicipioExterior
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idmunicipio_exterior", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idmunicipioExterior;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="departamento_iddepartamento", type="integer", nullable=false)
     */
    private $departamentoIddepartamento;



    /**
     * Get idmunicipioExterior
     *
     * @return integer
     */
    public function getIdmunicipioExterior()
    {
        return $this->idmunicipioExterior;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return MunicipioExterior
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
     * @return MunicipioExterior
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
