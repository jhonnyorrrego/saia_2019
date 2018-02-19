<?php

namespace Saia;

/**
 * PantallaFuncParam
 */
class PantallaFuncParam
{
    /**
     * @var integer
     */
    private $idpantallaFuncParam;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $valor;

    /**
     * @var integer
     */
    private $tipo;

    /**
     * @var integer
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

