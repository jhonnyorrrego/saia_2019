<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * PantallaFuncParam
 *
 * @ORM\Table(name="pantalla_func_param", indexes={@ORM\Index(name="i_pantfunc_parampant_funcexe1", columns={"fk_idpantalla_funcion_exe"})})
 * @ORM\Entity
 */
class PantallaFuncParam
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idpantalla_func_param", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idpantallaFuncParam;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="text", length=65535, nullable=false)
     */
    private $valor;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="fk_idpantalla_funcion_exe", type="integer", nullable=false)
     */
    private $fkIdpantallaFuncionExe;



    /**
     * Get idpantallaFuncParam
     *
     * @return integer
     */
    public function getIdpantallaFuncParam()
    {
        return $this->idpantallaFuncParam;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return PantallaFuncParam
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
     * Set valor
     *
     * @param string $valor
     *
     * @return PantallaFuncParam
     */
    public function setValor($valor)
    {
        $this->valor = $valor;

        return $this;
    }

    /**
     * Get valor
     *
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * Set tipo
     *
     * @param integer $tipo
     *
     * @return PantallaFuncParam
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return integer
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set fkIdpantallaFuncionExe
     *
     * @param integer $fkIdpantallaFuncionExe
     *
     * @return PantallaFuncParam
     */
    public function setFkIdpantallaFuncionExe($fkIdpantallaFuncionExe)
    {
        $this->fkIdpantallaFuncionExe = $fkIdpantallaFuncionExe;

        return $this;
    }

    /**
     * Get fkIdpantallaFuncionExe
     *
     * @return integer
     */
    public function getFkIdpantallaFuncionExe()
    {
        return $this->fkIdpantallaFuncionExe;
    }
}
