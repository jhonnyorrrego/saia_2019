<?php

namespace Saia;

/**
 * FtPantallaPrueba
 */
class FtPantallaPrueba
{
    /**
     * @var integer
     */
    private $idftPantallaPrueba;

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
     * @var \DateTime
     */
    private $datetime784162306;

    /**
     * @var string
     */
    private $contador1840892752;


    /**
     * Get idftPantallaPrueba
     *
     * @return integer
     */
    public function getIdftPantallaPrueba()
    {
        return $this->idftPantallaPrueba;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPantallaPrueba
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
     * @return FtPantallaPrueba
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
     * @return FtPantallaPrueba
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
     * Set datetime784162306
     *
     * @param \DateTime $datetime784162306
     *
     * @return FtPantallaPrueba
     */
    public function setDatetime784162306($datetime784162306)
    {
        $this->datetime784162306 = $datetime784162306;

        return $this;
    }

    /**
     * Get datetime784162306
     *
     * @return \DateTime
     */
    public function getDatetime784162306()
    {
        return $this->datetime784162306;
    }

    /**
     * Set contador1840892752
     *
     * @param string $contador1840892752
     *
     * @return FtPantallaPrueba
     */
    public function setContador1840892752($contador1840892752)
    {
        $this->contador1840892752 = $contador1840892752;

        return $this;
    }

    /**
     * Get contador1840892752
     *
     * @return string
     */
    public function getContador1840892752()
    {
        return $this->contador1840892752;
    }
}

