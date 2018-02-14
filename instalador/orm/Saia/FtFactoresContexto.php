<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFactoresContexto
 *
 * @ORM\Table(name="ft_factores_contexto")
 * @ORM\Entity
 */
class FtFactoresContexto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_factores_contexto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFactoresContexto;

    /**
     * @var string
     *
     * @ORM\Column(name="factores_contexto", type="decimal", precision=11, scale=0, nullable=false)
     */
    private $factoresContexto;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_contexto_extrategico", type="integer", nullable=false)
     */
    private $ftContextoExtrategico;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;



    /**
     * Get idftFactoresContexto
     *
     * @return integer
     */
    public function getIdftFactoresContexto()
    {
        return $this->idftFactoresContexto;
    }

    /**
     * Set factoresContexto
     *
     * @param string $factoresContexto
     *
     * @return FtFactoresContexto
     */
    public function setFactoresContexto($factoresContexto)
    {
        $this->factoresContexto = $factoresContexto;

        return $this;
    }

    /**
     * Get factoresContexto
     *
     * @return string
     */
    public function getFactoresContexto()
    {
        return $this->factoresContexto;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtFactoresContexto
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
     * Set ftContextoExtrategico
     *
     * @param integer $ftContextoExtrategico
     *
     * @return FtFactoresContexto
     */
    public function setFtContextoExtrategico($ftContextoExtrategico)
    {
        $this->ftContextoExtrategico = $ftContextoExtrategico;

        return $this;
    }

    /**
     * Get ftContextoExtrategico
     *
     * @return integer
     */
    public function getFtContextoExtrategico()
    {
        return $this->ftContextoExtrategico;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFactoresContexto
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
