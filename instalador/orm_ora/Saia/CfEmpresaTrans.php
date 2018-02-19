<?php

namespace Saia;

/**
 * CfEmpresaTrans
 */
class CfEmpresaTrans
{
    /**
     * @var integer
     */
    private $idcfEmpresaTrans;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var string
     */
    private $codPadre;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $categoria;

    /**
     * @var integer
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

