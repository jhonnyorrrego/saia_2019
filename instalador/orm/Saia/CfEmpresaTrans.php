<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * CfEmpresaTrans
 *
 * @ORM\Table(name="cf_empresa_trans", indexes={@ORM\Index(name="i_cf_empresa_t_categoria", columns={"categoria"})})
 * @ORM\Entity
 */
class CfEmpresaTrans
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idcf_empresa_trans", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idcfEmpresaTrans;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="valor", type="string", length=255, nullable=true)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="cod_padre", type="string", length=255, nullable=true)
     */
    private $codPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=true)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255, nullable=true)
     */
    private $categoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado", type="integer", nullable=true)
     */
    private $estado;



    /**
     * Get idcfEmpresaTrans
     *
     * @return integer
     */
    public function getIdcfEmpresaTrans()
    {
        return $this->idcfEmpresaTrans;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return CfEmpresaTrans
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
     * @return CfEmpresaTrans
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
     * Set codPadre
     *
     * @param string $codPadre
     *
     * @return CfEmpresaTrans
     */
    public function setCodPadre($codPadre)
    {
        $this->codPadre = $codPadre;

        return $this;
    }

    /**
     * Get codPadre
     *
     * @return string
     */
    public function getCodPadre()
    {
        return $this->codPadre;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return CfEmpresaTrans
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return CfEmpresaTrans
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     *
     * @return CfEmpresaTrans
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set estado
     *
     * @param integer $estado
     *
     * @return CfEmpresaTrans
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return integer
     */
    public function getEstado()
    {
        return $this->estado;
    }
}
