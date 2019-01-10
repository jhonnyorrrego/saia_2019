<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtControlDocumentos
 *
 * @ORM\Table(name="ft_control_documentos", indexes={@ORM\Index(name="i_ft_control_documentos_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_control_documentos_serie_doc_", columns={"serie_doc_control"}), @ORM\Index(name="i_control_documentos_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtControlDocumentos
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_control_documentos", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftControlDocumentos;

    /**
     * @var string
     *
     * @ORM\Column(name="listado_procesos", type="string", length=255, nullable=false)
     */
    private $listadoProcesos;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_documento", type="string", length=255, nullable=false)
     */
    private $nombreDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="almacenamiento", type="string", length=255, nullable=true)
     */
    private $almacenamiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_documento", type="integer", nullable=false)
     */
    private $tipoDocumento;

    /**
     * @var integer
     *
     * @ORM\Column(name="otros_documentos", type="integer", nullable=true)
     */
    private $otrosDocumentos;

    /**
     * @var integer
     *
     * @ORM\Column(name="version", type="integer", nullable=true)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="vigencia", type="string", length=255, nullable=true)
     */
    private $vigencia;

    /**
     * @var string
     *
     * @ORM\Column(name="origen_documento", type="string", length=11, nullable=false)
     */
    private $origenDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="secretaria", type="string", length=255, nullable=true)
     */
    private $secretaria;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_solicitud", type="integer", nullable=false)
     */
    private $tipoSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '4058';

    /**
     * @var string
     *
     * @ORM\Column(name="serie_doc_control", type="string", length=255, nullable=true)
     */
    private $serieDocControl;

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobacion", type="date", nullable=true)
     */
    private $fechaAprobacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="iddocumento_calidad", type="integer", nullable=true)
     */
    private $iddocumentoCalidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="idformato_calidad", type="integer", nullable=true)
     */
    private $idformatoCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_calidad", type="string", length=255, nullable=false)
     */
    private $documentoCalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="justificacion", type="text", length=65535, nullable=false)
     */
    private $justificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="propuesta", type="text", length=65535, nullable=false)
     */
    private $propuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var string
     *
     * @ORM\Column(name="revisado", type="string", length=255, nullable=false)
     */
    private $revisado;

    /**
     * @var string
     *
     * @ORM\Column(name="aprobado", type="string", length=255, nullable=false)
     */
    private $aprobado;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

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
     * @ORM\Column(name="iddocumento_creado", type="integer", nullable=true)
     */
    private $iddocumentoCreado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_vigencia", type="date", nullable=true)
     */
    private $fechaVigencia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_confirmacion", type="date", nullable=true)
     */
    private $fechaConfirmacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftControlDocumentos
     *
     * @return integer
     */
    public function getIdftControlDocumentos()
    {
        return $this->idftControlDocumentos;
    }

    /**
     * Set listadoProcesos
     *
     * @param string $listadoProcesos
     *
     * @return FtControlDocumentos
     */
    public function setListadoProcesos($listadoProcesos)
    {
        $this->listadoProcesos = $listadoProcesos;

        return $this;
    }

    /**
     * Get listadoProcesos
     *
     * @return string
     */
    public function getListadoProcesos()
    {
        return $this->listadoProcesos;
    }

    /**
     * Set nombreDocumento
     *
     * @param string $nombreDocumento
     *
     * @return FtControlDocumentos
     */
    public function setNombreDocumento($nombreDocumento)
    {
        $this->nombreDocumento = $nombreDocumento;

        return $this;
    }

    /**
     * Get nombreDocumento
     *
     * @return string
     */
    public function getNombreDocumento()
    {
        return $this->nombreDocumento;
    }

    /**
     * Set almacenamiento
     *
     * @param string $almacenamiento
     *
     * @return FtControlDocumentos
     */
    public function setAlmacenamiento($almacenamiento)
    {
        $this->almacenamiento = $almacenamiento;

        return $this;
    }

    /**
     * Get almacenamiento
     *
     * @return string
     */
    public function getAlmacenamiento()
    {
        return $this->almacenamiento;
    }

    /**
     * Set tipoDocumento
     *
     * @param integer $tipoDocumento
     *
     * @return FtControlDocumentos
     */
    public function setTipoDocumento($tipoDocumento)
    {
        $this->tipoDocumento = $tipoDocumento;

        return $this;
    }

    /**
     * Get tipoDocumento
     *
     * @return integer
     */
    public function getTipoDocumento()
    {
        return $this->tipoDocumento;
    }

    /**
     * Set otrosDocumentos
     *
     * @param integer $otrosDocumentos
     *
     * @return FtControlDocumentos
     */
    public function setOtrosDocumentos($otrosDocumentos)
    {
        $this->otrosDocumentos = $otrosDocumentos;

        return $this;
    }

    /**
     * Get otrosDocumentos
     *
     * @return integer
     */
    public function getOtrosDocumentos()
    {
        return $this->otrosDocumentos;
    }

    /**
     * Set version
     *
     * @param integer $version
     *
     * @return FtControlDocumentos
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set vigencia
     *
     * @param string $vigencia
     *
     * @return FtControlDocumentos
     */
    public function setVigencia($vigencia)
    {
        $this->vigencia = $vigencia;

        return $this;
    }

    /**
     * Get vigencia
     *
     * @return string
     */
    public function getVigencia()
    {
        return $this->vigencia;
    }

    /**
     * Set origenDocumento
     *
     * @param string $origenDocumento
     *
     * @return FtControlDocumentos
     */
    public function setOrigenDocumento($origenDocumento)
    {
        $this->origenDocumento = $origenDocumento;

        return $this;
    }

    /**
     * Get origenDocumento
     *
     * @return string
     */
    public function getOrigenDocumento()
    {
        return $this->origenDocumento;
    }

    /**
     * Set secretaria
     *
     * @param string $secretaria
     *
     * @return FtControlDocumentos
     */
    public function setSecretaria($secretaria)
    {
        $this->secretaria = $secretaria;

        return $this;
    }

    /**
     * Get secretaria
     *
     * @return string
     */
    public function getSecretaria()
    {
        return $this->secretaria;
    }

    /**
     * Set tipoSolicitud
     *
     * @param integer $tipoSolicitud
     *
     * @return FtControlDocumentos
     */
    public function setTipoSolicitud($tipoSolicitud)
    {
        $this->tipoSolicitud = $tipoSolicitud;

        return $this;
    }

    /**
     * Get tipoSolicitud
     *
     * @return integer
     */
    public function getTipoSolicitud()
    {
        return $this->tipoSolicitud;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtControlDocumentos
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
     * Set serieDocControl
     *
     * @param string $serieDocControl
     *
     * @return FtControlDocumentos
     */
    public function setSerieDocControl($serieDocControl)
    {
        $this->serieDocControl = $serieDocControl;

        return $this;
    }

    /**
     * Get serieDocControl
     *
     * @return string
     */
    public function getSerieDocControl()
    {
        return $this->serieDocControl;
    }

    /**
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtControlDocumentos
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
     * Set fechaAprobacion
     *
     * @param \DateTime $fechaAprobacion
     *
     * @return FtControlDocumentos
     */
    public function setFechaAprobacion($fechaAprobacion)
    {
        $this->fechaAprobacion = $fechaAprobacion;

        return $this;
    }

    /**
     * Get fechaAprobacion
     *
     * @return \DateTime
     */
    public function getFechaAprobacion()
    {
        return $this->fechaAprobacion;
    }

    /**
     * Set iddocumentoCalidad
     *
     * @param integer $iddocumentoCalidad
     *
     * @return FtControlDocumentos
     */
    public function setIddocumentoCalidad($iddocumentoCalidad)
    {
        $this->iddocumentoCalidad = $iddocumentoCalidad;

        return $this;
    }

    /**
     * Get iddocumentoCalidad
     *
     * @return integer
     */
    public function getIddocumentoCalidad()
    {
        return $this->iddocumentoCalidad;
    }

    /**
     * Set idformatoCalidad
     *
     * @param integer $idformatoCalidad
     *
     * @return FtControlDocumentos
     */
    public function setIdformatoCalidad($idformatoCalidad)
    {
        $this->idformatoCalidad = $idformatoCalidad;

        return $this;
    }

    /**
     * Get idformatoCalidad
     *
     * @return integer
     */
    public function getIdformatoCalidad()
    {
        return $this->idformatoCalidad;
    }

    /**
     * Set documentoCalidad
     *
     * @param string $documentoCalidad
     *
     * @return FtControlDocumentos
     */
    public function setDocumentoCalidad($documentoCalidad)
    {
        $this->documentoCalidad = $documentoCalidad;

        return $this;
    }

    /**
     * Get documentoCalidad
     *
     * @return string
     */
    public function getDocumentoCalidad()
    {
        return $this->documentoCalidad;
    }

    /**
     * Set justificacion
     *
     * @param string $justificacion
     *
     * @return FtControlDocumentos
     */
    public function setJustificacion($justificacion)
    {
        $this->justificacion = $justificacion;

        return $this;
    }

    /**
     * Get justificacion
     *
     * @return string
     */
    public function getJustificacion()
    {
        return $this->justificacion;
    }

    /**
     * Set propuesta
     *
     * @param string $propuesta
     *
     * @return FtControlDocumentos
     */
    public function setPropuesta($propuesta)
    {
        $this->propuesta = $propuesta;

        return $this;
    }

    /**
     * Get propuesta
     *
     * @return string
     */
    public function getPropuesta()
    {
        return $this->propuesta;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtControlDocumentos
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
     * Set revisado
     *
     * @param string $revisado
     *
     * @return FtControlDocumentos
     */
    public function setRevisado($revisado)
    {
        $this->revisado = $revisado;

        return $this;
    }

    /**
     * Get revisado
     *
     * @return string
     */
    public function getRevisado()
    {
        return $this->revisado;
    }

    /**
     * Set aprobado
     *
     * @param string $aprobado
     *
     * @return FtControlDocumentos
     */
    public function setAprobado($aprobado)
    {
        $this->aprobado = $aprobado;

        return $this;
    }

    /**
     * Get aprobado
     *
     * @return string
     */
    public function getAprobado()
    {
        return $this->aprobado;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtControlDocumentos
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtControlDocumentos
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
     * @return FtControlDocumentos
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
     * Set iddocumentoCreado
     *
     * @param integer $iddocumentoCreado
     *
     * @return FtControlDocumentos
     */
    public function setIddocumentoCreado($iddocumentoCreado)
    {
        $this->iddocumentoCreado = $iddocumentoCreado;

        return $this;
    }

    /**
     * Get iddocumentoCreado
     *
     * @return integer
     */
    public function getIddocumentoCreado()
    {
        return $this->iddocumentoCreado;
    }

    /**
     * Set fechaVigencia
     *
     * @param \DateTime $fechaVigencia
     *
     * @return FtControlDocumentos
     */
    public function setFechaVigencia($fechaVigencia)
    {
        $this->fechaVigencia = $fechaVigencia;

        return $this;
    }

    /**
     * Get fechaVigencia
     *
     * @return \DateTime
     */
    public function getFechaVigencia()
    {
        return $this->fechaVigencia;
    }

    /**
     * Set fechaConfirmacion
     *
     * @param \DateTime $fechaConfirmacion
     *
     * @return FtControlDocumentos
     */
    public function setFechaConfirmacion($fechaConfirmacion)
    {
        $this->fechaConfirmacion = $fechaConfirmacion;

        return $this;
    }

    /**
     * Get fechaConfirmacion
     *
     * @return \DateTime
     */
    public function getFechaConfirmacion()
    {
        return $this->fechaConfirmacion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtControlDocumentos
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
