<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtAusentesActa
 *
 * @ORM\Table(name="ft_ausentes_acta")
 * @ORM\Entity
 */
class FtAusentesActa
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_ausentes_acta", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftAusentesActa;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_acta", type="integer", nullable=false)
     */
    private $ftActa;

    /**
     * @var string
     *
     * @ORM\Column(name="funcionario_ausente", type="string", length=255, nullable=false)
     */
    private $funcionarioAusente;

    /**
     * @var integer
     *
     * @ORM\Column(name="justificada", type="integer", nullable=false)
     */
    private $justificada = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
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
