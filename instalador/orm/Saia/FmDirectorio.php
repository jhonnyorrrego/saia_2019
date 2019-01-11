<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FmDirectorio
 *
 * @ORM\Table(name="fm_directorio", indexes={@ORM\Index(name="fk_directorio_funcionario_idx", columns={"funcionario_idfuncionario"}), @ORM\Index(name="fk_directorio_regional1_idx", columns={"regional_idregional"}), @ORM\Index(name="fk_fm_directorio_fm_directorio1_idx", columns={"directorio_iddirectorio"}), @ORM\Index(name="fk_fm_directorio_funcionario1_idx", columns={"propietario"})})
 * @ORM\Entity
 */
class FmDirectorio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="iddirectorio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $iddirectorio;

    /**
     * @var string
     *
     * @ORM\Column(name="ruta", type="string", length=4000, nullable=false)
     */
    private $ruta;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="regional_idregional", type="integer", nullable=true)
     */
    private $regionalIdregional;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="directorio_iddirectorio", type="integer", nullable=true)
     */
    private $directorioIddirectorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="propietario", type="integer", nullable=true)
     */
    private $propietario;


    /**
     * Get iddirectorio
     *
     * @return integer
     */
    public function getIddirectorio()
    {
        return $this->iddirectorio;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return FmDirectorio
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
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FmDirectorio
     */
    public function setFuncionarioIdfuncionario($funcionarioIdfuncionario)
    {
        $this->funcionarioIdfuncionario = $funcionarioIdfuncionario;

        return $this;
    }

    /**
     * Get funcionarioIdfuncionario
     *
     * @return integer
     */
    public function getFuncionarioIdfuncionario()
    {
        return $this->funcionarioIdfuncionario;
    }

    /**
     * Set regionalIdregional
     *
     * @param integer $regionalIdregional
     *
     * @return FmDirectorio
     */
    public function setRegionalIdregional($regionalIdregional)
    {
        $this->regionalIdregional = $regionalIdregional;

        return $this;
    }

    /**
     * Get regionalIdregional
     *
     * @return integer
     */
    public function getRegionalIdregional()
    {
        return $this->regionalIdregional;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FmDirectorio
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set directorioIddirectorio
     *
     * @param integer $directorioIddirectorio
     *
     * @return FmDirectorio
     */
    public function setDirectorioIddirectorio($directorioIddirectorio)
    {
        $this->directorioIddirectorio = $directorioIddirectorio;

        return $this;
    }

    /**
     * Get directorioIddirectorio
     *
     * @return integer
     */
    public function getDirectorioIddirectorio()
    {
        return $this->directorioIddirectorio;
    }

    /**
     * Set propietario
     *
     * @param integer $propietario
     *
     * @return FmDirectorio
     */
    public function setPropietario($propietario)
    {
        $this->propietario = $propietario;

        return $this;
    }

    /**
     * Get propietario
     *
     * @return integer
     */
    public function getPropietario()
    {
        return $this->propietario;
    }
}
