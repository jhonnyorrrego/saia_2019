<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FmPermisoDirectorio
 *
 * @ORM\Table(name="fm_permiso_directorio", indexes={@ORM\Index(name="fk_permiso_directorio_funcionario1_idx", columns={"funcionario_idfuncionario"}), @ORM\Index(name="fk_permiso_directorio_directorio1_idx", columns={"directorio_iddirectorio"})})
 * @ORM\Entity
 */
class FmPermisoDirectorio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpermiso_directorio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idpermisoDirectorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_idfuncionario", type="integer", nullable=false)
     */
    private $funcionarioIdfuncionario;

    /**
     * @var integer
     *
     * @ORM\Column(name="directorio_iddirectorio", type="integer", nullable=false)
     */
    private $directorioIddirectorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="lectura", type="integer", nullable=false)
     */
    private $lectura;

    /**
     * @var integer
     *
     * @ORM\Column(name="escritura", type="integer", nullable=false)
     */
    private $escritura;


    /**
     * Get idpermisoDirectorio
     *
     * @return integer
     */
    public function getIdpermisoDirectorio()
    {
        return $this->idpermisoDirectorio;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return FmPermisoDirectorio
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
     * Set directorioIddirectorio
     *
     * @param integer $directorioIddirectorio
     *
     * @return FmPermisoDirectorio
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
     * Set lectura
     *
     * @param integer $lectura
     *
     * @return FmPermisoDirectorio
     */
    public function setLectura($lectura)
    {
        $this->lectura = $lectura;

        return $this;
    }

    /**
     * Get lectura
     *
     * @return integer
     */
    public function getLectura()
    {
        return $this->lectura;
    }

    /**
     * Set escritura
     *
     * @param integer $escritura
     *
     * @return FmPermisoDirectorio
     */
    public function setEscritura($escritura)
    {
        $this->escritura = $escritura;

        return $this;
    }

    /**
     * Get escritura
     *
     * @return integer
     */
    public function getEscritura()
    {
        return $this->escritura;
    }
}
