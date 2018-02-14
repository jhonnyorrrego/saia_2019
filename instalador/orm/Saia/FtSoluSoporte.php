<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSoluSoporte
 *
 * @ORM\Table(name="ft_solu_soporte")
 * @ORM\Entity
 */
class FtSoluSoporte
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solu_soporte", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSoluSoporte;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_clasif_solicitud", type="integer", nullable=false)
     */
    private $ftClasifSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1193';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_soluc", type="date", nullable=false)
     */
    private $fechaSoluc;

    /**
     * @var string
     *
     * @ORM\Column(name="solucion", type="text", length=65535, nullable=false)
     */
    private $solucion;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_causa", type="string", length=255, nullable=false)
     */
    private $tipoCausa;

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
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftSoluSoporte
     *
     * @return integer
     */
    public function getIdftSoluSoporte()
    {
        return $this->idftSoluSoporte;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSoluSoporte
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
     * Set ftClasifSolicitud
     *
     * @param integer $ftClasifSolicitud
     *
     * @return FtSoluSoporte
     */
    public function setFtClasifSolicitud($ftClasifSolicitud)
    {
        $this->ftClasifSolicitud = $ftClasifSolicitud;

        return $this;
    }

    /**
     * Get ftClasifSolicitud
     *
     * @return integer
     */
    public function getFtClasifSolicitud()
    {
        return $this->ftClasifSolicitud;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSoluSoporte
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
     * Set fechaSoluc
     *
     * @param \DateTime $fechaSoluc
     *
     * @return FtSoluSoporte
     */
    public function setFechaSoluc($fechaSoluc)
    {
        $this->fechaSoluc = $fechaSoluc;

        return $this;
    }

    /**
     * Get fechaSoluc
     *
     * @return \DateTime
     */
    public function getFechaSoluc()
    {
        return $this->fechaSoluc;
    }

    /**
     * Set solucion
     *
     * @param string $solucion
     *
     * @return FtSoluSoporte
     */
    public function setSolucion($solucion)
    {
        $this->solucion = $solucion;

        return $this;
    }

    /**
     * Get solucion
     *
     * @return string
     */
    public function getSolucion()
    {
        return $this->solucion;
    }

    /**
     * Set tipoCausa
     *
     * @param string $tipoCausa
     *
     * @return FtSoluSoporte
     */
    public function setTipoCausa($tipoCausa)
    {
        $this->tipoCausa = $tipoCausa;

        return $this;
    }

    /**
     * Get tipoCausa
     *
     * @return string
     */
    public function getTipoCausa()
    {
        return $this->tipoCausa;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSoluSoporte
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
     * @return FtSoluSoporte
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
     * @return FtSoluSoporte
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
     * @return FtSoluSoporte
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSoluSoporte
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
