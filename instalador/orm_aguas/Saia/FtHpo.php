<?php

namespace Saia;

/**
 * FtHpo
 */
class FtHpo
{
    /**
     * @var integer
     */
    private $idftHpo;

    /**
     * @var integer
     */
    private $ftRequisicionCompra;

    /**
     * @var string
     */
    private $phid;

    /**
     * @var string
     */
    private $pline;

    /**
     * @var integer
     */
    private $pqord;

    /**
     * @var \DateTime
     */
    private $pddte;

    /**
     * @var integer
     */
    private $numeroRequesicion;

    /**
     * @var integer
     */
    private $codigoProducto;

    /**
     * @var integer
     */
    private $codigoUnidadMedida;

    /**
     * @var integer
     */
    private $serieIdserie;


    /**
     * Get idftHpo
     *
     * @return integer
     */
    public function getIdftHpo()
    {
        return $this->idftHpo;
    }

    /**
     * Set ftRequisicionCompra
     *
     * @param integer $ftRequisicionCompra
     *
     * @return FtHpo
     */
    public function setFtRequisicionCompra($ftRequisicionCompra)
    {
        $this->ftRequisicionCompra = $ftRequisicionCompra;

        return $this;
    }

    /**
     * Get ftRequisicionCompra
     *
     * @return integer
     */
    public function getFtRequisicionCompra()
    {
        return $this->ftRequisicionCompra;
    }

    /**
     * Set phid
     *
     * @param string $phid
     *
     * @return FtHpo
     */
    public function setPhid($phid)
    {
        $this->phid = $phid;

        return $this;
    }

    /**
     * Get phid
     *
     * @return string
     */
    public function getPhid()
    {
        return $this->phid;
    }

    /**
     * Set pline
     *
     * @param string $pline
     *
     * @return FtHpo
     */
    public function setPline($pline)
    {
        $this->pline = $pline;

        return $this;
    }

    /**
     * Get pline
     *
     * @return string
     */
    public function getPline()
    {
        return $this->pline;
    }

    /**
     * Set pqord
     *
     * @param integer $pqord
     *
     * @return FtHpo
     */
    public function setPqord($pqord)
    {
        $this->pqord = $pqord;

        return $this;
    }

    /**
     * Get pqord
     *
     * @return integer
     */
    public function getPqord()
    {
        return $this->pqord;
    }

    /**
     * Set pddte
     *
     * @param \DateTime $pddte
     *
     * @return FtHpo
     */
    public function setPddte($pddte)
    {
        $this->pddte = $pddte;

        return $this;
    }

    /**
     * Get pddte
     *
     * @return \DateTime
     */
    public function getPddte()
    {
        return $this->pddte;
    }

    /**
     * Set numeroRequesicion
     *
     * @param integer $numeroRequesicion
     *
     * @return FtHpo
     */
    public function setNumeroRequesicion($numeroRequesicion)
    {
        $this->numeroRequesicion = $numeroRequesicion;

        return $this;
    }

    /**
     * Get numeroRequesicion
     *
     * @return integer
     */
    public function getNumeroRequesicion()
    {
        return $this->numeroRequesicion;
    }

    /**
     * Set codigoProducto
     *
     * @param integer $codigoProducto
     *
     * @return FtHpo
     */
    public function setCodigoProducto($codigoProducto)
    {
        $this->codigoProducto = $codigoProducto;

        return $this;
    }

    /**
     * Get codigoProducto
     *
     * @return integer
     */
    public function getCodigoProducto()
    {
        return $this->codigoProducto;
    }

    /**
     * Set codigoUnidadMedida
     *
     * @param integer $codigoUnidadMedida
     *
     * @return FtHpo
     */
    public function setCodigoUnidadMedida($codigoUnidadMedida)
    {
        $this->codigoUnidadMedida = $codigoUnidadMedida;

        return $this;
    }

    /**
     * Get codigoUnidadMedida
     *
     * @return integer
     */
    public function getCodigoUnidadMedida()
    {
        return $this->codigoUnidadMedida;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtHpo
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

