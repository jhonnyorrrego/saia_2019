<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSolicitudServicio
 *
 * @ORM\Table(name="ft_solicitud_servicio")
 * @ORM\Entity
 */
class FtSolicitudServicio
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_solicitud_servicio", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftSolicitudServicio;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '980';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_hora_solicitud", type="datetime", nullable=false)
     */
    private $fechaHoraSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="ciudad_origen", type="integer", nullable=false)
     */
    private $ciudadOrigen;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_solicitud_servi", type="integer", nullable=false)
     */
    private $tipoSolicitudServi;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo_mercancia", type="string", length=255, nullable=false)
     */
    private $tipoMercancia;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_privilegios", type="integer", nullable=false)
     */
    private $tipoPrivilegios;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_envio_solicitud", type="integer", nullable=false)
     */
    private $tipoEnvioSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_declarado", type="integer", nullable=true)
     */
    private $valorDeclarado;

    /**
     * @var string
     *
     * @ORM\Column(name="peso_envio_solicitud", type="string", length=255, nullable=true)
     */
    private $pesoEnvioSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="tamanio_aproximado", type="string", length=255, nullable=true)
     */
    private $tamanioAproximado;

    /**
     * @var integer
     *
     * @ORM\Column(name="requiere_recoleccion", type="integer", nullable=false)
     */
    private $requiereRecoleccion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion_recoleccion", type="string", length=255, nullable=true)
     */
    private $direccionRecoleccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_recoleccion", type="date", nullable=true)
     */
    private $fechaRecoleccion;

    /**
     * @var string
     *
     * @ORM\Column(name="observacion_solicitud", type="text", length=65535, nullable=true)
     */
    private $observacionSolicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

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
     * @ORM\Column(name="asunto_solicitud", type="string", length=255, nullable=false)
     */
    private $asuntoSolicitud;

    /**
     * @var integer
     *
     * @ORM\Column(name="referencia_caja", type="integer", nullable=true)
     */
    private $referenciaCaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad_mercancia", type="integer", nullable=true)
     */
    private $cantidadMercancia;

    /**
     * @var string
     *
     * @ORM\Column(name="fk_idsolicitud_afiliacion", type="string", length=255, nullable=false)
     */
    private $fkIdsolicitudAfiliacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftSolicitudServicio
     *
     * @return integer
     */
    public function getIdftSolicitudServicio()
    {
        return $this->idftSolicitudServicio;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSolicitudServicio
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
     * Set fechaHoraSolicitud
     *
     * @param \DateTime $fechaHoraSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setFechaHoraSolicitud($fechaHoraSolicitud)
    {
        $this->fechaHoraSolicitud = $fechaHoraSolicitud;

        return $this;
    }

    /**
     * Get fechaHoraSolicitud
     *
     * @return \DateTime
     */
    public function getFechaHoraSolicitud()
    {
        return $this->fechaHoraSolicitud;
    }

    /**
     * Set ciudadOrigen
     *
     * @param integer $ciudadOrigen
     *
     * @return FtSolicitudServicio
     */
    public function setCiudadOrigen($ciudadOrigen)
    {
        $this->ciudadOrigen = $ciudadOrigen;

        return $this;
    }

    /**
     * Get ciudadOrigen
     *
     * @return integer
     */
    public function getCiudadOrigen()
    {
        return $this->ciudadOrigen;
    }

    /**
     * Set tipoSolicitudServi
     *
     * @param integer $tipoSolicitudServi
     *
     * @return FtSolicitudServicio
     */
    public function setTipoSolicitudServi($tipoSolicitudServi)
    {
        $this->tipoSolicitudServi = $tipoSolicitudServi;

        return $this;
    }

    /**
     * Get tipoSolicitudServi
     *
     * @return integer
     */
    public function getTipoSolicitudServi()
    {
        return $this->tipoSolicitudServi;
    }

    /**
     * Set tipoMercancia
     *
     * @param string $tipoMercancia
     *
     * @return FtSolicitudServicio
     */
    public function setTipoMercancia($tipoMercancia)
    {
        $this->tipoMercancia = $tipoMercancia;

        return $this;
    }

    /**
     * Get tipoMercancia
     *
     * @return string
     */
    public function getTipoMercancia()
    {
        return $this->tipoMercancia;
    }

    /**
     * Set tipoPrivilegios
     *
     * @param integer $tipoPrivilegios
     *
     * @return FtSolicitudServicio
     */
    public function setTipoPrivilegios($tipoPrivilegios)
    {
        $this->tipoPrivilegios = $tipoPrivilegios;

        return $this;
    }

    /**
     * Get tipoPrivilegios
     *
     * @return integer
     */
    public function getTipoPrivilegios()
    {
        return $this->tipoPrivilegios;
    }

    /**
     * Set tipoEnvioSolicitud
     *
     * @param integer $tipoEnvioSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setTipoEnvioSolicitud($tipoEnvioSolicitud)
    {
        $this->tipoEnvioSolicitud = $tipoEnvioSolicitud;

        return $this;
    }

    /**
     * Get tipoEnvioSolicitud
     *
     * @return integer
     */
    public function getTipoEnvioSolicitud()
    {
        return $this->tipoEnvioSolicitud;
    }

    /**
     * Set valorDeclarado
     *
     * @param integer $valorDeclarado
     *
     * @return FtSolicitudServicio
     */
    public function setValorDeclarado($valorDeclarado)
    {
        $this->valorDeclarado = $valorDeclarado;

        return $this;
    }

    /**
     * Get valorDeclarado
     *
     * @return integer
     */
    public function getValorDeclarado()
    {
        return $this->valorDeclarado;
    }

    /**
     * Set pesoEnvioSolicitud
     *
     * @param string $pesoEnvioSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setPesoEnvioSolicitud($pesoEnvioSolicitud)
    {
        $this->pesoEnvioSolicitud = $pesoEnvioSolicitud;

        return $this;
    }

    /**
     * Get pesoEnvioSolicitud
     *
     * @return string
     */
    public function getPesoEnvioSolicitud()
    {
        return $this->pesoEnvioSolicitud;
    }

    /**
     * Set tamanioAproximado
     *
     * @param string $tamanioAproximado
     *
     * @return FtSolicitudServicio
     */
    public function setTamanioAproximado($tamanioAproximado)
    {
        $this->tamanioAproximado = $tamanioAproximado;

        return $this;
    }

    /**
     * Get tamanioAproximado
     *
     * @return string
     */
    public function getTamanioAproximado()
    {
        return $this->tamanioAproximado;
    }

    /**
     * Set requiereRecoleccion
     *
     * @param integer $requiereRecoleccion
     *
     * @return FtSolicitudServicio
     */
    public function setRequiereRecoleccion($requiereRecoleccion)
    {
        $this->requiereRecoleccion = $requiereRecoleccion;

        return $this;
    }

    /**
     * Get requiereRecoleccion
     *
     * @return integer
     */
    public function getRequiereRecoleccion()
    {
        return $this->requiereRecoleccion;
    }

    /**
     * Set direccionRecoleccion
     *
     * @param string $direccionRecoleccion
     *
     * @return FtSolicitudServicio
     */
    public function setDireccionRecoleccion($direccionRecoleccion)
    {
        $this->direccionRecoleccion = $direccionRecoleccion;

        return $this;
    }

    /**
     * Get direccionRecoleccion
     *
     * @return string
     */
    public function getDireccionRecoleccion()
    {
        return $this->direccionRecoleccion;
    }

    /**
     * Set fechaRecoleccion
     *
     * @param \DateTime $fechaRecoleccion
     *
     * @return FtSolicitudServicio
     */
    public function setFechaRecoleccion($fechaRecoleccion)
    {
        $this->fechaRecoleccion = $fechaRecoleccion;

        return $this;
    }

    /**
     * Get fechaRecoleccion
     *
     * @return \DateTime
     */
    public function getFechaRecoleccion()
    {
        return $this->fechaRecoleccion;
    }

    /**
     * Set observacionSolicitud
     *
     * @param string $observacionSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setObservacionSolicitud($observacionSolicitud)
    {
        $this->observacionSolicitud = $observacionSolicitud;

        return $this;
    }

    /**
     * Get observacionSolicitud
     *
     * @return string
     */
    public function getObservacionSolicitud()
    {
        return $this->observacionSolicitud;
    }

    /**
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtSolicitudServicio
     */
    public function setAnexosDigitales($anexosDigitales)
    {
        $this->anexosDigitales = $anexosDigitales;

        return $this;
    }

    /**
     * Get anexosDigitales
     *
     * @return string
     */
    public function getAnexosDigitales()
    {
        return $this->anexosDigitales;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSolicitudServicio
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
     * @return FtSolicitudServicio
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
     * @return FtSolicitudServicio
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
     * @return FtSolicitudServicio
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
     * Set asuntoSolicitud
     *
     * @param string $asuntoSolicitud
     *
     * @return FtSolicitudServicio
     */
    public function setAsuntoSolicitud($asuntoSolicitud)
    {
        $this->asuntoSolicitud = $asuntoSolicitud;

        return $this;
    }

    /**
     * Get asuntoSolicitud
     *
     * @return string
     */
    public function getAsuntoSolicitud()
    {
        return $this->asuntoSolicitud;
    }

    /**
     * Set referenciaCaja
     *
     * @param integer $referenciaCaja
     *
     * @return FtSolicitudServicio
     */
    public function setReferenciaCaja($referenciaCaja)
    {
        $this->referenciaCaja = $referenciaCaja;

        return $this;
    }

    /**
     * Get referenciaCaja
     *
     * @return integer
     */
    public function getReferenciaCaja()
    {
        return $this->referenciaCaja;
    }

    /**
     * Set cantidadMercancia
     *
     * @param integer $cantidadMercancia
     *
     * @return FtSolicitudServicio
     */
    public function setCantidadMercancia($cantidadMercancia)
    {
        $this->cantidadMercancia = $cantidadMercancia;

        return $this;
    }

    /**
     * Get cantidadMercancia
     *
     * @return integer
     */
    public function getCantidadMercancia()
    {
        return $this->cantidadMercancia;
    }

    /**
     * Set fkIdsolicitudAfiliacion
     *
     * @param string $fkIdsolicitudAfiliacion
     *
     * @return FtSolicitudServicio
     */
    public function setFkIdsolicitudAfiliacion($fkIdsolicitudAfiliacion)
    {
        $this->fkIdsolicitudAfiliacion = $fkIdsolicitudAfiliacion;

        return $this;
    }

    /**
     * Get fkIdsolicitudAfiliacion
     *
     * @return string
     */
    public function getFkIdsolicitudAfiliacion()
    {
        return $this->fkIdsolicitudAfiliacion;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSolicitudServicio
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
