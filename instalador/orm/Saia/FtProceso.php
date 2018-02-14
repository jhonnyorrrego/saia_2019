<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtProceso
 *
 * @ORM\Table(name="ft_proceso")
 * @ORM\Entity
 */
class FtProceso
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_proceso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftProceso;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '8';

    /**
     * @var string
     *
     * @ORM\Column(name="lider_proceso", type="string", length=255, nullable=false)
     */
    private $liderProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="estado", type="string", length=255, nullable=false)
     */
    private $estado = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=255, nullable=true)
     */
    private $codigo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var string
     *
     * @ORM\Column(name="objetivo", type="text", length=65535, nullable=false)
     */
    private $objetivo;

    /**
     * @var string
     *
     * @ORM\Column(name="politica_operacion", type="text", length=65535, nullable=true)
     */
    private $politicaOperacion;

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
     * @ORM\Column(name="coordenadas", type="string", length=255, nullable=true)
     */
    private $coordenadas;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=false)
     */
    private $responsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="macroproceso", type="integer", nullable=true)
     */
    private $macroproceso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobacion_rie", type="datetime", nullable=true)
     */
    private $fechaAprobacionRie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_revision_riesg", type="datetime", nullable=true)
     */
    private $fechaRevisionRiesg;

    /**
     * @var string
     *
     * @ORM\Column(name="vigencia", type="string", length=255, nullable=true)
     */
    private $vigencia;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_proceso", type="string", length=255, nullable=true)
     */
    private $descripcionProceso;

    /**
     * @var string
     *
     * @ORM\Column(name="alcance", type="text", length=65535, nullable=false)
     */
    private $alcance;

    /**
     * @var string
     *
     * @ORM\Column(name="listado_maestro_documentos", type="string", length=255, nullable=true)
     */
    private $listadoMaestroDocumentos;

    /**
     * @var string
     *
     * @ORM\Column(name="listado_maestro_registros", type="string", length=255, nullable=true)
     */
    private $listadoMaestroRegistros;

    /**
     * @var string
     *
     * @ORM\Column(name="acta", type="string", length=255, nullable=true)
     */
    private $acta;

    /**
     * @var string
     *
     * @ORM\Column(name="aprobado_por", type="string", length=255, nullable=true)
     */
    private $aprobadoPor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_aprobacion", type="datetime", nullable=true)
     */
    private $fechaAprobacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_revision", type="datetime", nullable=true)
     */
    private $fechaRevision;

    /**
     * @var string
     *
     * @ORM\Column(name="secretarias", type="string", length=255, nullable=true)
     */
    private $secretarias;

    /**
     * @var string
     *
     * @ORM\Column(name="permisos_acceso", type="string", length=255, nullable=true)
     */
    private $permisosAcceso;

    /**
     * @var string
     *
     * @ORM\Column(name="dependencias_partici", type="string", length=255, nullable=false)
     */
    private $dependenciasPartici;

    /**
     * @var string
     *
     * @ORM\Column(name="revisado_por", type="string", length=255, nullable=true)
     */
    private $revisadoPor;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftProceso
     *
     * @return integer
     */
    public function getIdftProceso()
    {
        return $this->idftProceso;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtProceso
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
     * Set liderProceso
     *
     * @param string $liderProceso
     *
     * @return FtProceso
     */
    public function setLiderProceso($liderProceso)
    {
        $this->liderProceso = $liderProceso;

        return $this;
    }

    /**
     * Get liderProceso
     *
     * @return string
     */
    public function getLiderProceso()
    {
        return $this->liderProceso;
    }

    /**
     * Set estado
     *
     * @param string $estado
     *
     * @return FtProceso
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return string
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtProceso
     */
    public function setAnexos($anexos)
    {
        $this->anexos = $anexos;

        return $this;
    }

    /**
     * Get anexos
     *
     * @return string
     */
    public function getAnexos()
    {
        return $this->anexos;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     *
     * @return FtProceso
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get codigo
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtProceso
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtProceso
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set version
     *
     * @param string $version
     *
     * @return FtProceso
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set objetivo
     *
     * @param string $objetivo
     *
     * @return FtProceso
     */
    public function setObjetivo($objetivo)
    {
        $this->objetivo = $objetivo;

        return $this;
    }

    /**
     * Get objetivo
     *
     * @return string
     */
    public function getObjetivo()
    {
        return $this->objetivo;
    }

    /**
     * Set politicaOperacion
     *
     * @param string $politicaOperacion
     *
     * @return FtProceso
     */
    public function setPoliticaOperacion($politicaOperacion)
    {
        $this->politicaOperacion = $politicaOperacion;

        return $this;
    }

    /**
     * Get politicaOperacion
     *
     * @return string
     */
    public function getPoliticaOperacion()
    {
        return $this->politicaOperacion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtProceso
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
     * @return FtProceso
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
     * @return FtProceso
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
     * @return FtProceso
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
     * Set coordenadas
     *
     * @param string $coordenadas
     *
     * @return FtProceso
     */
    public function setCoordenadas($coordenadas)
    {
        $this->coordenadas = $coordenadas;

        return $this;
    }

    /**
     * Get coordenadas
     *
     * @return string
     */
    public function getCoordenadas()
    {
        return $this->coordenadas;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return FtProceso
     */
    public function setResponsable($responsable)
    {
        $this->responsable = $responsable;

        return $this;
    }

    /**
     * Get responsable
     *
     * @return string
     */
    public function getResponsable()
    {
        return $this->responsable;
    }

    /**
     * Set macroproceso
     *
     * @param integer $macroproceso
     *
     * @return FtProceso
     */
    public function setMacroproceso($macroproceso)
    {
        $this->macroproceso = $macroproceso;

        return $this;
    }

    /**
     * Get macroproceso
     *
     * @return integer
     */
    public function getMacroproceso()
    {
        return $this->macroproceso;
    }

    /**
     * Set fechaAprobacionRie
     *
     * @param \DateTime $fechaAprobacionRie
     *
     * @return FtProceso
     */
    public function setFechaAprobacionRie($fechaAprobacionRie)
    {
        $this->fechaAprobacionRie = $fechaAprobacionRie;

        return $this;
    }

    /**
     * Get fechaAprobacionRie
     *
     * @return \DateTime
     */
    public function getFechaAprobacionRie()
    {
        return $this->fechaAprobacionRie;
    }

    /**
     * Set fechaRevisionRiesg
     *
     * @param \DateTime $fechaRevisionRiesg
     *
     * @return FtProceso
     */
    public function setFechaRevisionRiesg($fechaRevisionRiesg)
    {
        $this->fechaRevisionRiesg = $fechaRevisionRiesg;

        return $this;
    }

    /**
     * Get fechaRevisionRiesg
     *
     * @return \DateTime
     */
    public function getFechaRevisionRiesg()
    {
        return $this->fechaRevisionRiesg;
    }

    /**
     * Set vigencia
     *
     * @param string $vigencia
     *
     * @return FtProceso
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
     * Set descripcionProceso
     *
     * @param string $descripcionProceso
     *
     * @return FtProceso
     */
    public function setDescripcionProceso($descripcionProceso)
    {
        $this->descripcionProceso = $descripcionProceso;

        return $this;
    }

    /**
     * Get descripcionProceso
     *
     * @return string
     */
    public function getDescripcionProceso()
    {
        return $this->descripcionProceso;
    }

    /**
     * Set alcance
     *
     * @param string $alcance
     *
     * @return FtProceso
     */
    public function setAlcance($alcance)
    {
        $this->alcance = $alcance;

        return $this;
    }

    /**
     * Get alcance
     *
     * @return string
     */
    public function getAlcance()
    {
        return $this->alcance;
    }

    /**
     * Set listadoMaestroDocumentos
     *
     * @param string $listadoMaestroDocumentos
     *
     * @return FtProceso
     */
    public function setListadoMaestroDocumentos($listadoMaestroDocumentos)
    {
        $this->listadoMaestroDocumentos = $listadoMaestroDocumentos;

        return $this;
    }

    /**
     * Get listadoMaestroDocumentos
     *
     * @return string
     */
    public function getListadoMaestroDocumentos()
    {
        return $this->listadoMaestroDocumentos;
    }

    /**
     * Set listadoMaestroRegistros
     *
     * @param string $listadoMaestroRegistros
     *
     * @return FtProceso
     */
    public function setListadoMaestroRegistros($listadoMaestroRegistros)
    {
        $this->listadoMaestroRegistros = $listadoMaestroRegistros;

        return $this;
    }

    /**
     * Get listadoMaestroRegistros
     *
     * @return string
     */
    public function getListadoMaestroRegistros()
    {
        return $this->listadoMaestroRegistros;
    }

    /**
     * Set acta
     *
     * @param string $acta
     *
     * @return FtProceso
     */
    public function setActa($acta)
    {
        $this->acta = $acta;

        return $this;
    }

    /**
     * Get acta
     *
     * @return string
     */
    public function getActa()
    {
        return $this->acta;
    }

    /**
     * Set aprobadoPor
     *
     * @param string $aprobadoPor
     *
     * @return FtProceso
     */
    public function setAprobadoPor($aprobadoPor)
    {
        $this->aprobadoPor = $aprobadoPor;

        return $this;
    }

    /**
     * Get aprobadoPor
     *
     * @return string
     */
    public function getAprobadoPor()
    {
        return $this->aprobadoPor;
    }

    /**
     * Set fechaAprobacion
     *
     * @param \DateTime $fechaAprobacion
     *
     * @return FtProceso
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
     * Set fechaRevision
     *
     * @param \DateTime $fechaRevision
     *
     * @return FtProceso
     */
    public function setFechaRevision($fechaRevision)
    {
        $this->fechaRevision = $fechaRevision;

        return $this;
    }

    /**
     * Get fechaRevision
     *
     * @return \DateTime
     */
    public function getFechaRevision()
    {
        return $this->fechaRevision;
    }

    /**
     * Set secretarias
     *
     * @param string $secretarias
     *
     * @return FtProceso
     */
    public function setSecretarias($secretarias)
    {
        $this->secretarias = $secretarias;

        return $this;
    }

    /**
     * Get secretarias
     *
     * @return string
     */
    public function getSecretarias()
    {
        return $this->secretarias;
    }

    /**
     * Set permisosAcceso
     *
     * @param string $permisosAcceso
     *
     * @return FtProceso
     */
    public function setPermisosAcceso($permisosAcceso)
    {
        $this->permisosAcceso = $permisosAcceso;

        return $this;
    }

    /**
     * Get permisosAcceso
     *
     * @return string
     */
    public function getPermisosAcceso()
    {
        return $this->permisosAcceso;
    }

    /**
     * Set dependenciasPartici
     *
     * @param string $dependenciasPartici
     *
     * @return FtProceso
     */
    public function setDependenciasPartici($dependenciasPartici)
    {
        $this->dependenciasPartici = $dependenciasPartici;

        return $this;
    }

    /**
     * Get dependenciasPartici
     *
     * @return string
     */
    public function getDependenciasPartici()
    {
        return $this->dependenciasPartici;
    }

    /**
     * Set revisadoPor
     *
     * @param string $revisadoPor
     *
     * @return FtProceso
     */
    public function setRevisadoPor($revisadoPor)
    {
        $this->revisadoPor = $revisadoPor;

        return $this;
    }

    /**
     * Get revisadoPor
     *
     * @return string
     */
    public function getRevisadoPor()
    {
        return $this->revisadoPor;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtProceso
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
