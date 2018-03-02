<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitSoporte
 *
 * @ORM\Table(name="ft_solicit_soporte")
 * @ORM\Entity
 */
class FtSolicitSoporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicit_soporte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftSolicitSoporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1185';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_req", type="date", nullable=false)
     */
    private $fechaReq;

    /**
     * @var string
     *
     * @ORM\Column(name="soli_sop", type="text", length=65535, nullable=false)
     */
    private $soliSop;

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
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_clasif_soporte", type="integer", nullable=false)
     */
    private $ftClasifSoporte;



    /**
     * Get idftSolicitSoporte
     *
     * @return integer
     */
    public function getIdftSolicitSoporte()
    {
        return $this->idftSolicitSoporte;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitSoporte
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
     * Set fechaReq
     *
     * @param \DateTime $fechaReq
     *
     * @return FtSolicitSoporte
     */
    public function setFechaReq($fechaReq)
    {
        $this->fechaReq = $fechaReq;

        return $this;
    }

    /**
     * Get fechaReq
     *
     * @return \DateTime
     */
    public function getFechaReq()
    {
        return $this->fechaReq;
    }

    /**
     * Set soliSop
     *
     * @param string $soliSop
     *
     * @return FtSolicitSoporte
     */
    public function setSoliSop($soliSop)
    {
        $this->soliSop = $soliSop;

        return $this;
    }

    /**
     * Get soliSop
     *
     * @return string
     */
    public function getSoliSop()
    {
        return $this->soliSop;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitSoporte
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
     * @return FtSolicitSoporte
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
     * @return FtSolicitSoporte
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
     * @return FtSolicitSoporte
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
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSolicitSoporte
     */
    public function setAnexoFormato($anexoFormato)
    {
        $this->anexoFormato = $anexoFormato;

        return $this;
    }

    /**
     * Get anexoFormato
     *
     * @return string
     */
    public function getAnexoFormato()
    {
        return $this->anexoFormato;
    }

    /**
     * Set ftClasifSoporte
     *
     * @param integer $ftClasifSoporte
     *
     * @return FtSolicitSoporte
     */
    public function setFtClasifSoporte($ftClasifSoporte)
    {
        $this->ftClasifSoporte = $ftClasifSoporte;

        return $this;
    }

    /**
     * Get ftClasifSoporte
     *
     * @return integer
     */
    public function getFtClasifSoporte()
    {
        return $this->ftClasifSoporte;
    }
}
