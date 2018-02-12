<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtClasifSolicitud
 *
 * @ORM\Table(name="ft_clasif_solicitud", indexes={@ORM\Index(name="i_ft_clasif_solicitud_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_clasif_solicitud_solicit_as", columns={"ft_solicit_asistenc"}), @ORM\Index(name="i_clasif_solicitud_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtClasifSolicitud
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_clasif_solicitud", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftClasifSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_solicit_asistenc", type="integer", nullable=false)
     */
    private $ftSolicitAsistenc;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1190';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_clas", type="date", nullable=false)
     */
    private $fechaClas;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_clas", type="string", length=255, nullable=false)
     */
    private $tipoClas;

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
     * Get idftClasifSolicitud
     *
     * @return integer
     */
    public function getIdftClasifSolicitud()
    {
        return $this->idftClasifSolicitud;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtClasifSolicitud
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
     * Set ftSolicitAsistenc
     *
     * @param integer $ftSolicitAsistenc
     *
     * @return FtClasifSolicitud
     */
    public function setFtSolicitAsistenc($ftSolicitAsistenc)
    {
        $this->ftSolicitAsistenc = $ftSolicitAsistenc;

        return $this;
    }

    /**
     * Get ftSolicitAsistenc
     *
     * @return integer
     */
    public function getFtSolicitAsistenc()
    {
        return $this->ftSolicitAsistenc;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtClasifSolicitud
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
     * Set fechaClas
     *
     * @param \DateTime $fechaClas
     *
     * @return FtClasifSolicitud
     */
    public function setFechaClas($fechaClas)
    {
        $this->fechaClas = $fechaClas;

        return $this;
    }

    /**
     * Get fechaClas
     *
     * @return \DateTime
     */
    public function getFechaClas()
    {
        return $this->fechaClas;
    }

    /**
     * Set tipoClas
     *
     * @param string $tipoClas
     *
     * @return FtClasifSolicitud
     */
    public function setTipoClas($tipoClas)
    {
        $this->tipoClas = $tipoClas;

        return $this;
    }

    /**
     * Get tipoClas
     *
     * @return string
     */
    public function getTipoClas()
    {
        return $this->tipoClas;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtClasifSolicitud
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
     * @return FtClasifSolicitud
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
     * @return FtClasifSolicitud
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
     * @return FtClasifSolicitud
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
     * @return FtClasifSolicitud
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
