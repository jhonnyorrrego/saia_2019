<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRequisicionCompra
 *
 * @ORM\Table(name="ft_requisicion_compra")
 * @ORM\Entity
 */
class FtRequisicionCompra
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_requisicion_compra", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftRequisicionCompra;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1050';

    /**
     * @var string
     *
     * @ORM\Column(name="phid", type="string", length=255, nullable=true)
     */
    private $phid;

    /**
     * @var string
     *
     * @ORM\Column(name="phord", type="string", length=255, nullable=true)
     */
    private $phord;

    /**
     * @var string
     *
     * @ORM\Column(name="phstat", type="string", length=255, nullable=true)
     */
    private $phstat;

    /**
     * @var string
     *
     * @ORM\Column(name="phcomp", type="string", length=255, nullable=true)
     */
    private $phcomp;

    /**
     * @var string
     *
     * @ORM\Column(name="phfac", type="string", length=255, nullable=true)
     */
    private $phfac;

    /**
     * @var string
     *
     * @ORM\Column(name="phship", type="string", length=255, nullable=true)
     */
    private $phship;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="phendt", type="date", nullable=true)
     */
    private $phendt;

    /**
     * @var string
     *
     * @ORM\Column(name="phcur", type="string", length=255, nullable=true)
     */
    private $phcur;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="campo_phrqid", type="integer", nullable=true)
     */
    private $campoPhrqid;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo_comprador", type="integer", nullable=true)
     */
    private $codigoComprador;

    /**
     * @var integer
     *
     * @ORM\Column(name="codigo_proveedor", type="integer", nullable=true)
     */
    private $codigoProveedor;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
