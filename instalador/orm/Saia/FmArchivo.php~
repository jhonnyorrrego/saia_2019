<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FmArchivo
 *
 * @ORM\Table(name="fm_archivo", indexes={@ORM\Index(name="fk_archivo_directorio1_idx", columns={"directorio_iddirectorio"}), @ORM\Index(name="fk_archivo_funcionario1_idx", columns={"funcionario_idfuncionario"}), @ORM\Index(name="archivo_nombre_idx", columns={"nombre"})})
 * @ORM\Entity
 */
class FmArchivo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idarchivo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idarchivo;

    /**
     * @var integer
     *
     * @ORM\Column(name="directorio_iddirectorio", type="integer", nullable=false)
     */
    private $directorioIddirectorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="formato", type="string", length=50, nullable=false)
     */
    private $formato;

    /**
     * @var integer
     *
     * @ORM\Column(name="peso", type="integer", nullable=false)
     */
    private $peso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=false)
     */
    private $fecha;



    /**
     * Get idarchivo
     *
     * @return integer
     */
    public function getIdarchivo()
    {
        return $this->idarchivo;
    }

    /**
     * Set directorioIddirectorio
     *
     * @param integer $directorioIddirectorio
     *
     * @return FmArchivo
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
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FmArchivo
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FmArchivo
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
     * Set formato
     *
     * @param string $formato
     *
     * @return FmArchivo
     */
    public function setFormato($formato)
    {
        $this->formato = $formato;

        return $this;
    }

    /**
     * Get formato
     *
     * @return string
     */
    public function getFormato()
    {
        return $this->formato;
    }

    /**
     * Set peso
     *
     * @param integer $peso
     *
     * @return FmArchivo
     */
    public function setPeso($peso)
    {
        $this->peso = $peso;

        return $this;
    }

    /**
     * Get peso
     *
     * @return integer
     */
    public function getPeso()
    {
        return $this->peso;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FmArchivo
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
}
