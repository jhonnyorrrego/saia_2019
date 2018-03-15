<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etiqueta
 *
 * @ORM\Table(name="etiqueta")
 * @ORM\Entity
 */
class Etiqueta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idetiqueta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idetiqueta;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario", type="string", length=255, nullable=false)
     */
    private $funcionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="privada_saia", type="integer", nullable=false)
     */
    private $privadaSaia = '0';



    /**
     * Get idetiqueta
     *
     * @return integer
     */
    public function getIdetiqueta()
    {
        return $this->idetiqueta;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Etiqueta
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
     * Set funcionario
     *
     * @param string $funcionario
     *
     * @return Etiqueta
     */
    public function setFuncionario($funcionario)
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    /**
     * Get funcionario
     *
     * @return string
     */
    public function getFuncionario()
    {
        return $this->funcionario;
    }

    /**
     * Set privadaSaia
     *
     * @param integer $privadaSaia
     *
     * @return Etiqueta
     */
    public function setPrivadaSaia($privadaSaia)
    {
        $this->privadaSaia = $privadaSaia;

        return $this;
    }

    /**
     * Get privadaSaia
     *
     * @return integer
     */
    public function getPrivadaSaia()
    {
        return $this->privadaSaia;
    }
}
