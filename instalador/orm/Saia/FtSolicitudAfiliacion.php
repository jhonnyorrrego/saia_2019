<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudAfiliacion
 *
 * @ORM\Table(name="ft_solicitud_afiliacion")
 * @ORM\Entity
 */
class FtSolicitudAfiliacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_afiliacion", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftSolicitudAfiliacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '987';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_solicitud", type="date", nullable=false)
     */
    private $fechaSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="datos_solicitante", type="string", length=255, nullable=false)
     */
    private $datosSolicitante;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_folios_afilia", type="integer", nullable=false)
     */
    private $numeroFoliosAfilia;

    /**
     * @var string
     *
     * @ORM\Column(name="adjuntar_documento", type="string", length=255, nullable=true)
     */
    private $adjuntarDocumento;

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
     * Get idftSolicitudAfiliacion
     *
     * @return integer
     */
    public function getIdftSolicitudAfiliacion()
    {
        return $this->idftSolicitudAfiliacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudAfiliacion
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
     * Set fechaSolicitud
     *
     * @param \DateTime $fechaSolicitud
     *
     * @return FtSolicitudAfiliacion
     */
    public function setFechaSolicitud($fechaSolicitud)
    {
        $this->fechaSolicitud = $fechaSolicitud;

        return $this;
    }

    /**
     * Get fechaSolicitud
     *
     * @return \DateTime
     */
    public function getFechaSolicitud()
    {
        return $this->fechaSolicitud;
    }

    /**
     * Set datosSolicitante
     *
     * @param string $datosSolicitante
     *
     * @return FtSolicitudAfiliacion
     */
    public function setDatosSolicitante($datosSolicitante)
    {
        $this->datosSolicitante = $datosSolicitante;

        return $this;
    }

    /**
     * Get datosSolicitante
     *
     * @return string
     */
    public function getDatosSolicitante()
    {
        return $this->datosSolicitante;
    }

    /**
     * Set numeroFoliosAfilia
     *
     * @param integer $numeroFoliosAfilia
     *
     * @return FtSolicitudAfiliacion
     */
    public function setNumeroFoliosAfilia($numeroFoliosAfilia)
    {
        $this->numeroFoliosAfilia = $numeroFoliosAfilia;

        return $this;
    }

    /**
     * Get numeroFoliosAfilia
     *
     * @return integer
     */
    public function getNumeroFoliosAfilia()
    {
        return $this->numeroFoliosAfilia;
    }

    /**
     * Set adjuntarDocumento
     *
     * @param string $adjuntarDocumento
     *
     * @return FtSolicitudAfiliacion
     */
    public function setAdjuntarDocumento($adjuntarDocumento)
    {
        $this->adjuntarDocumento = $adjuntarDocumento;

        return $this;
    }

    /**
     * Get adjuntarDocumento
     *
     * @return string
     */
    public function getAdjuntarDocumento()
    {
        return $this->adjuntarDocumento;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudAfiliacion
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
     * @return FtSolicitudAfiliacion
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
     * @return FtSolicitudAfiliacion
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
     * @return FtSolicitudAfiliacion
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
     * @return FtSolicitudAfiliacion
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
