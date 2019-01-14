<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtActaRecibo
 *
 * @ORM\Table(name="ft_acta_recibo", indexes={@ORM\Index(name="i_ft_acta_recibo_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_acta_recibo_clasif_sol", columns={"ft_clasif_solicitud"}), @ORM\Index(name="i_acta_recibo_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtActaRecibo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_acta_recibo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftActaRecibo;

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
    private $serieIdserie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_cta", type="date", nullable=false)
     */
    private $fechaCta;

    /**
     * @var string
     *
     * @ORM\Column(name="entrega", type="text", length=65535, nullable=false)
     */
    private $entrega;

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
    private $encabezado;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento;


    /**
     * Get idftActaRecibo
     *
     * @return integer
     */
    public function getIdftActaRecibo()
    {
        return $this->idftActaRecibo;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtActaRecibo
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
     * @return FtActaRecibo
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
     * @return FtActaRecibo
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
     * Set fechaCta
     *
     * @param \DateTime $fechaCta
     *
     * @return FtActaRecibo
     */
    public function setFechaCta($fechaCta)
    {
        $this->fechaCta = $fechaCta;

        return $this;
    }

    /**
     * Get fechaCta
     *
     * @return \DateTime
     */
    public function getFechaCta()
    {
        return $this->fechaCta;
    }

    /**
     * Set entrega
     *
     * @param string $entrega
     *
     * @return FtActaRecibo
     */
    public function setEntrega($entrega)
    {
        $this->entrega = $entrega;

        return $this;
    }

    /**
     * Get entrega
     *
     * @return string
     */
    public function getEntrega()
    {
        return $this->entrega;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtActaRecibo
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
     * @return FtActaRecibo
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
     * @return FtActaRecibo
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
     * @return FtActaRecibo
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
     * @return FtActaRecibo
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
