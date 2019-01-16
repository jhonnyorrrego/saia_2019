<?php

namespace Saia;

/**
 * AnexosTmp
 */
class AnexosTmp
{
    /**
     * @var integer
     */
    private $idanexosTmp;

    /**
     * @var string
     */
    private $uuid;

    /**
     * @var string
     */
    private $ruta;

    /**
     * @var string
     */
    private $etiqueta;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var \DateTime
     */
    private $fechaAnexo;

    /**
     * @var integer
     */
    private $idformato;

    /**
     * @var integer
     */
    private $idcamposFormato;

    /**
     * @var integer
     */
    private $funcionarioIdfuncionario;


    /**
     * Get idanexosTmp
     *
     * @return integer
     */
    public function getIdanexosTmp()
    {
        return $this->idanexosTmp;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     *
     * @return AnexosTmp
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set ruta
     *
     * @param string $ruta
     *
     * @return AnexosTmp
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
     * Set etiqueta
     *
     * @param string $etiqueta
     *
     * @return AnexosTmp
     */
    public function setEtiqueta($etiqueta)
    {
        $this->etiqueta = $etiqueta;

        return $this;
    }

    /**
     * Get etiqueta
     *
     * @return string
     */
    public function getEtiqueta()
    {
        return $this->etiqueta;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return AnexosTmp
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
     * Set fechaAnexo
     *
     * @param \DateTime $fechaAnexo
     *
     * @return AnexosTmp
     */
    public function setFechaAnexo($fechaAnexo)
    {
        $this->fechaAnexo = $fechaAnexo;

        return $this;
    }

    /**
     * Get fechaAnexo
     *
     * @return \DateTime
     */
    public function getFechaAnexo()
    {
        return $this->fechaAnexo;
    }

    /**
     * Set idformato
     *
     * @param integer $idformato
     *
     * @return AnexosTmp
     */
    public function setIdformato($idformato)
    {
        $this->idformato = $idformato;

        return $this;
    }

    /**
     * Get idformato
     *
     * @return integer
     */
    public function getIdformato()
    {
        return $this->idformato;
    }

    /**
     * Set idcamposFormato
     *
     * @param integer $idcamposFormato
     *
     * @return AnexosTmp
     */
    public function setIdcamposFormato($idcamposFormato)
    {
        $this->idcamposFormato = $idcamposFormato;

        return $this;
    }

    /**
     * Get idcamposFormato
     *
     * @return integer
     */
    public function getIdcamposFormato()
    {
        return $this->idcamposFormato;
    }

    /**
     * Set funcionarioIdfuncionario
     *
     * @param integer $funcionarioIdfuncionario
     *
     * @return AnexosTmp
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
}

