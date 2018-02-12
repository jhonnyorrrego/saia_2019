<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitRespeuesto
 *
 * @ORM\Table(name="ft_solicit_respeuesto", indexes={@ORM\Index(name="i_solicit_respeuesto_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_solicit_respeuesto_clasif_sol", columns={"ft_clasif_solicitud"}), @ORM\Index(name="i_solicit_respeuesto_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtSolicitRespeuesto
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicit_respeuesto", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSolicitRespeuesto;

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
    private $serieIdserie = '1192';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_repuesto", type="date", nullable=false)
     */
    private $fechaRepuesto;

    /**
     * @var string
     *
     * @ORM\Column(name="repuesto", type="string", length=255, nullable=false)
     */
    private $repuesto;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer", nullable=false)
     */
    private $cantidad;

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
     * Get idftSolicitRespeuesto
     *
     * @return integer
     */
    public function getIdftSolicitRespeuesto()
    {
        return $this->idftSolicitRespeuesto;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
     * Set fechaRepuesto
     *
     * @param \DateTime $fechaRepuesto
     *
     * @return FtSolicitRespeuesto
     */
    public function setFechaRepuesto($fechaRepuesto)
    {
        $this->fechaRepuesto = $fechaRepuesto;

        return $this;
    }

    /**
     * Get fechaRepuesto
     *
     * @return \DateTime
     */
    public function getFechaRepuesto()
    {
        return $this->fechaRepuesto;
    }

    /**
     * Set repuesto
     *
     * @param string $repuesto
     *
     * @return FtSolicitRespeuesto
     */
    public function setRepuesto($repuesto)
    {
        $this->repuesto = $repuesto;

        return $this;
    }

    /**
     * Get repuesto
     *
     * @return string
     */
    public function getRepuesto()
    {
        return $this->repuesto;
    }

    /**
     * Set cantidad
     *
     * @param integer $cantidad
     *
     * @return FtSolicitRespeuesto
     */
    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;

        return $this;
    }

    /**
     * Get cantidad
     *
     * @return integer
     */
    public function getCantidad()
    {
        return $this->cantidad;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
     * @return FtSolicitRespeuesto
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
