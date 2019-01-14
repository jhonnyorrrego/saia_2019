<?php

namespace Saia;

/**
 * FtPruebaComprasV10
 */
class FtPruebaComprasV10
{
    /**
     * @var integer
     */
    private $idftPruebaCompras;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var string
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $estadoFormato;

    /**
     * @var string
     */
    private $arbolRadioFuncionario;

    /**
     * @var \DateTime
     */
    private $date451910049;


    /**
     * Get idftPruebaCompras
     *
     * @return integer
     */
    public function getIdftPruebaCompras()
    {
        return $this->idftPruebaCompras;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPruebaComprasV10
     */
    public function setSerieIdserie($serieIdserie)
    {
        $this->serieIdserie = $serieIdserie;

        return $this;
    }

    /**
     * Get serieIdserie
     *
     * @return integer
     */
    public function getSerieIdserie()
    {
        return $this->serieIdserie;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPruebaComprasV10
     */
    public function setDocumentoIddocumento($documentoIddocumento)
    {
        $this->documentoIddocumento = $documentoIddocumento;

        return $this;
    }

    /**
     * Get documentoIddocumento
     *
     * @return integer
     */
    public function getDocumentoIddocumento()
    {
        return $this->documentoIddocumento;
    }

    /**
     * Set dependencia
     *
     * @param string $dependencia
     *
     * @return FtPruebaComprasV10
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return string
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set estadoFormato
     *
     * @param integer $estadoFormato
     *
     * @return FtPruebaComprasV10
     */
    public function setEstadoFormato($estadoFormato)
    {
        $this->estadoFormato = $estadoFormato;

        return $this;
    }

    /**
     * Get estadoFormato
     *
     * @return integer
     */
    public function getEstadoFormato()
    {
        return $this->estadoFormato;
    }

    /**
     * Set arbolRadioFuncionario
     *
     * @param string $arbolRadioFuncionario
     *
     * @return FtPruebaComprasV10
     */
    public function setArbolRadioFuncionario($arbolRadioFuncionario)
    {
        $this->arbolRadioFuncionario = $arbolRadioFuncionario;

        return $this;
    }

    /**
     * Get arbolRadioFuncionario
     *
     * @return string
     */
    public function getArbolRadioFuncionario()
    {
        return $this->arbolRadioFuncionario;
    }

    /**
     * Set date451910049
     *
     * @param \DateTime $date451910049
     *
     * @return FtPruebaComprasV10
     */
    public function setDate451910049($date451910049)
    {
        $this->date451910049 = $date451910049;

        return $this;
    }

    /**
     * Get date451910049
     *
     * @return \DateTime
     */
    public function getDate451910049()
    {
        return $this->date451910049;
    }
}

