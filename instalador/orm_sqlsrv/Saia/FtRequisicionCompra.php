<?php

namespace Saia;

/**
 * FtRequisicionCompra
 */
class FtRequisicionCompra
{
    /**
     * @var integer
     */
    private $idftRequisicionCompra;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $phid;

    /**
     * @var string
     */
    private $phord;

    /**
     * @var string
     */
    private $phstat;

    /**
     * @var string
     */
    private $phcomp;

    /**
     * @var string
     */
    private $phfac;

    /**
     * @var string
     */
    private $phship;

    /**
     * @var \DateTime
     */
    private $phendt;

    /**
     * @var string
     */
    private $phcur;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $campoPhrqid;

    /**
     * @var integer
     */
    private $codigoComprador;

    /**
     * @var integer
     */
    private $codigoProveedor;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftRequisicionCompra
     *
     * @return integer
     */
    public function getIdftRequisicionCompra()
    {
        return $this->idftRequisicionCompra;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRequisicionCompra
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
     * Set phid
     *
     * @param string $phid
     *
     * @return FtRequisicionCompra
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
     * Set phord
     *
     * @param string $phord
     *
     * @return FtRequisicionCompra
     */
    public function setPhord($phord)
    {
        $this->phord = $phord;

        return $this;
    }

    /**
     * Get phord
     *
     * @return string
     */
    public function getPhord()
    {
        return $this->phord;
    }

    /**
     * Set phstat
     *
     * @param string $phstat
     *
     * @return FtRequisicionCompra
     */
    public function setPhstat($phstat)
    {
        $this->phstat = $phstat;

        return $this;
    }

    /**
     * Get phstat
     *
     * @return string
     */
    public function getPhstat()
    {
        return $this->phstat;
    }

    /**
     * Set phcomp
     *
     * @param string $phcomp
     *
     * @return FtRequisicionCompra
     */
    public function setPhcomp($phcomp)
    {
        $this->phcomp = $phcomp;

        return $this;
    }

    /**
     * Get phcomp
     *
     * @return string
     */
    public function getPhcomp()
    {
        return $this->phcomp;
    }

    /**
     * Set phfac
     *
     * @param string $phfac
     *
     * @return FtRequisicionCompra
     */
    public function setPhfac($phfac)
    {
        $this->phfac = $phfac;

        return $this;
    }

    /**
     * Get phfac
     *
     * @return string
     */
    public function getPhfac()
    {
        return $this->phfac;
    }

    /**
     * Set phship
     *
     * @param string $phship
     *
     * @return FtRequisicionCompra
     */
    public function setPhship($phship)
    {
        $this->phship = $phship;

        return $this;
    }

    /**
     * Get phship
     *
     * @return string
     */
    public function getPhship()
    {
        return $this->phship;
    }

    /**
     * Set phendt
     *
     * @param \DateTime $phendt
     *
     * @return FtRequisicionCompra
     */
    public function setPhendt($phendt)
    {
        $this->phendt = $phendt;

        return $this;
    }

    /**
     * Get phendt
     *
     * @return \DateTime
     */
    public function getPhendt()
    {
        return $this->phendt;
    }

    /**
     * Set phcur
     *
     * @param string $phcur
     *
     * @return FtRequisicionCompra
     */
    public function setPhcur($phcur)
    {
        $this->phcur = $phcur;

        return $this;
    }

    /**
     * Get phcur
     *
     * @return string
     */
    public function getPhcur()
    {
        return $this->phcur;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRequisicionCompra
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
     * @param integer $dependencia
     *
     * @return FtRequisicionCompra
     */
    public function setDependencia($dependencia)
    {
        $this->dependencia = $dependencia;

        return $this;
    }

    /**
     * Get dependencia
     *
     * @return integer
     */
    public function getDependencia()
    {
        return $this->dependencia;
    }

    /**
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtRequisicionCompra
     */
    public function setEncabezado($encabezado)
    {
        $this->encabezado = $encabezado;

        return $this;
    }

    /**
     * Get encabezado
     *
     * @return integer
     */
    public function getEncabezado()
    {
        return $this->encabezado;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtRequisicionCompra
     */
    public function setFirma($firma)
    {
        $this->firma = $firma;

        return $this;
    }

    /**
     * Get firma
     *
     * @return integer
     */
    public function getFirma()
    {
        return $this->firma;
    }

    /**
     * Set campoPhrqid
     *
     * @param integer $campoPhrqid
     *
     * @return FtRequisicionCompra
     */
    public function setCampoPhrqid($campoPhrqid)
    {
        $this->campoPhrqid = $campoPhrqid;

        return $this;
    }

    /**
     * Get campoPhrqid
     *
     * @return integer
     */
    public function getCampoPhrqid()
    {
        return $this->campoPhrqid;
    }

    /**
     * Set codigoComprador
     *
     * @param integer $codigoComprador
     *
     * @return FtRequisicionCompra
     */
    public function setCodigoComprador($codigoComprador)
    {
        $this->codigoComprador = $codigoComprador;

        return $this;
    }

    /**
     * Get codigoComprador
     *
     * @return integer
     */
    public function getCodigoComprador()
    {
        return $this->codigoComprador;
    }

    /**
     * Set codigoProveedor
     *
     * @param integer $codigoProveedor
     *
     * @return FtRequisicionCompra
     */
    public function setCodigoProveedor($codigoProveedor)
    {
        $this->codigoProveedor = $codigoProveedor;

        return $this;
    }

    /**
     * Get codigoProveedor
     *
     * @return integer
     */
    public function getCodigoProveedor()
    {
        return $this->codigoProveedor;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRequisicionCompra
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return integer
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}

