<?php

namespace Saia;

/**
 * FtAusentesActa
 */
class FtAusentesActa
{
    /**
     * @var integer
     */
    private $idftAusentesActa;

    /**
     * @var integer
     */
    private $ftActa;

    /**
     * @var string
     */
    private $funcionarioAusente;

    /**
     * @var integer
     */
    private $justificada;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftAusentesActa
     *
     * @return integer
     */
    public function getIdftAusentesActa()
    {
        return $this->idftAusentesActa;
    }

    /**
     * Set ftActa
     *
     * @param integer $ftActa
     *
     * @return FtAusentesActa
     */
    public function setFtActa($ftActa)
    {
        $this->ftActa = $ftActa;

        return $this;
    }

    /**
     * Get ftActa
     *
     * @return integer
     */
    public function getFtActa()
    {
        return $this->ftActa;
    }

    /**
     * Set funcionarioAusente
     *
     * @param string $funcionarioAusente
     *
     * @return FtAusentesActa
     */
    public function setFuncionarioAusente($funcionarioAusente)
    {
        $this->funcionarioAusente = $funcionarioAusente;

        return $this;
    }

    /**
     * Get funcionarioAusente
     *
     * @return string
     */
    public function getFuncionarioAusente()
    {
        return $this->funcionarioAusente;
    }

    /**
     * Set justificada
     *
     * @param integer $justificada
     *
     * @return FtAusentesActa
     */
    public function setJustificada($justificada)
    {
        $this->justificada = $justificada;

        return $this;
    }

    /**
     * Get justificada
     *
     * @return integer
     */
    public function getJustificada()
    {
        return $this->justificada;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtAusentesActa
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
}

