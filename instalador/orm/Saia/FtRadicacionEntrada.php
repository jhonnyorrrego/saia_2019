<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtRadicacionEntrada
 *
 * @ORM\Table(name="ft_radicacion_entrada")
 * @ORM\Entity
 */
class FtRadicacionEntrada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_radicacion_entrada", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftRadicacionEntrada;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_oficio", type="string", length=255, nullable=true)
     */
    private $numeroOficio;

    /**
     * @var string
     *
     * @ORM\Column(name="persona_natural", type="string", length=255, nullable=true)
     */
    private $personaNatural;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_anexos", type="text", length=65535, nullable=true)
     */
    private $descripcionAnexos;

    /**
     * @var string
     *
     * @ORM\Column(name="anexos_digitales", type="string", length=255, nullable=true)
     */
    private $anexosDigitales;

    /**
     * @var string
     *
     * @ORM\Column(name="destino", type="text", length=65535, nullable=true)
     */
    private $destino;

    /**
     * @var string
     *
     * @ORM\Column(name="copia_a", type="text", length=65535, nullable=true)
     */
    private $copiaA;

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
     * @ORM\Column(name="idflujo", type="string", length=255, nullable=true)
     */
    private $idflujo = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=true)
     */
    private $serieIdserie = '1317';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_radicacion_entrada", type="datetime", nullable=false)
     */
    private $fechaRadicacionEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_radicado", type="integer", nullable=true)
     */
    private $numeroRadicado;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_radicado", type="string", length=255, nullable=true)
     */
    private $estadoRadicado = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_oficio_entrada", type="date", nullable=true)
     */
    private $fechaOficioEntrada;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_origen", type="integer", nullable=false)
     */
    private $tipoOrigen = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="area_responsable", type="string", length=255, nullable=true)
     */
    private $areaResponsable;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_destino", type="integer", nullable=false)
     */
    private $tipoDestino = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="persona_natural_dest", type="string", length=255, nullable=true)
     */
    private $personaNaturalDest;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_mensajeria", type="integer", nullable=true)
     */
    private $tipoMensajeria;

    /**
     * @var integer
     *
     * @ORM\Column(name="despachado", type="integer", nullable=false)
     */
    private $despachado;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa_transportado", type="string", length=255, nullable=true)
     */
    private $empresaTransportado;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_guia", type="string", length=255, nullable=true)
     */
    private $numeroGuia;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="tiempo_respuesta", type="date", nullable=true)
     */
    private $tiempoRespuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion_general", type="string", length=255, nullable=true)
     */
    private $descripcionGeneral;

    /**
     * @var integer
     *
     * @ORM\Column(name="requiere_recogida", type="integer", nullable=true)
     */
    private $requiereRecogida = '1';



    /**
     * Get idftRadicacionEntrada
     *
     * @return integer
     */
    public function getIdftRadicacionEntrada()
    {
        return $this->idftRadicacionEntrada;
    }

    /**
     * Set numeroOficio
     *
     * @param string $numeroOficio
     *
     * @return FtRadicacionEntrada
     */
    public function setNumeroOficio($numeroOficio)
    {
        $this->numeroOficio = $numeroOficio;

        return $this;
    }

    /**
     * Get numeroOficio
     *
     * @return string
     */
    public function getNumeroOficio()
    {
        return $this->numeroOficio;
    }

    /**
     * Set personaNatural
     *
     * @param string $personaNatural
     *
     * @return FtRadicacionEntrada
     */
    public function setPersonaNatural($personaNatural)
    {
        $this->personaNatural = $personaNatural;

        return $this;
    }

    /**
     * Get personaNatural
     *
     * @return string
     */
    public function getPersonaNatural()
    {
        return $this->personaNatural;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtRadicacionEntrada
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set descripcionAnexos
     *
     * @param string $descripcionAnexos
     *
     * @return FtRadicacionEntrada
     */
    public function setDescripcionAnexos($descripcionAnexos)
    {
        $this->descripcionAnexos = $descripcionAnexos;

        return $this;
    }

    /**
     * Get descripcionAnexos
     *
     * @return string
     */
    public function getDescripcionAnexos()
    {
        return $this->descripcionAnexos;
    }

    /**
     * Set anexosDigitales
     *
     * @param string $anexosDigitales
     *
     * @return FtRadicacionEntrada
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
     * Set destino
     *
     * @param string $destino
     *
     * @return FtRadicacionEntrada
     */
    public function setDestino($destino)
    {
        $this->destino = $destino;

        return $this;
    }

    /**
     * Get destino
     *
     * @return string
     */
    public function getDestino()
    {
        return $this->destino;
    }

    /**
     * Set copiaA
     *
     * @param string $copiaA
     *
     * @return FtRadicacionEntrada
     */
    public function setCopiaA($copiaA)
    {
        $this->copiaA = $copiaA;

        return $this;
    }

    /**
     * Get copiaA
     *
     * @return string
     */
    public function getCopiaA()
    {
        return $this->copiaA;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtRadicacionEntrada
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
     * @return FtRadicacionEntrada
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
     * @return FtRadicacionEntrada
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
     * @return FtRadicacionEntrada
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
     * Set idflujo
     *
     * @param string $idflujo
     *
     * @return FtRadicacionEntrada
     */
    public function setIdflujo($idflujo)
    {
        $this->idflujo = $idflujo;

        return $this;
    }

    /**
     * Get idflujo
     *
     * @return string
     */
    public function getIdflujo()
    {
        return $this->idflujo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtRadicacionEntrada
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
     * Set fechaRadicacionEntrada
     *
     * @param \DateTime $fechaRadicacionEntrada
     *
     * @return FtRadicacionEntrada
     */
    public function setFechaRadicacionEntrada($fechaRadicacionEntrada)
    {
        $this->fechaRadicacionEntrada = $fechaRadicacionEntrada;

        return $this;
    }

    /**
     * Get fechaRadicacionEntrada
     *
     * @return \DateTime
     */
    public function getFechaRadicacionEntrada()
    {
        return $this->fechaRadicacionEntrada;
    }

    /**
     * Set numeroRadicado
     *
     * @param integer $numeroRadicado
     *
     * @return FtRadicacionEntrada
     */
    public function setNumeroRadicado($numeroRadicado)
    {
        $this->numeroRadicado = $numeroRadicado;

        return $this;
    }

    /**
     * Get numeroRadicado
     *
     * @return integer
     */
    public function getNumeroRadicado()
    {
        return $this->numeroRadicado;
    }

    /**
     * Set estadoRadicado
     *
     * @param string $estadoRadicado
     *
     * @return FtRadicacionEntrada
     */
    public function setEstadoRadicado($estadoRadicado)
    {
        $this->estadoRadicado = $estadoRadicado;

        return $this;
    }

    /**
     * Get estadoRadicado
     *
     * @return string
     */
    public function getEstadoRadicado()
    {
        return $this->estadoRadicado;
    }

    /**
     * Set fechaOficioEntrada
     *
     * @param \DateTime $fechaOficioEntrada
     *
     * @return FtRadicacionEntrada
     */
    public function setFechaOficioEntrada($fechaOficioEntrada)
    {
        $this->fechaOficioEntrada = $fechaOficioEntrada;

        return $this;
    }

    /**
     * Get fechaOficioEntrada
     *
     * @return \DateTime
     */
    public function getFechaOficioEntrada()
    {
        return $this->fechaOficioEntrada;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtRadicacionEntrada
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

    /**
     * Set tipoOrigen
     *
     * @param integer $tipoOrigen
     *
     * @return FtRadicacionEntrada
     */
    public function setTipoOrigen($tipoOrigen)
    {
        $this->tipoOrigen = $tipoOrigen;

        return $this;
    }

    /**
     * Get tipoOrigen
     *
     * @return integer
     */
    public function getTipoOrigen()
    {
        return $this->tipoOrigen;
    }

    /**
     * Set areaResponsable
     *
     * @param string $areaResponsable
     *
     * @return FtRadicacionEntrada
     */
    public function setAreaResponsable($areaResponsable)
    {
        $this->areaResponsable = $areaResponsable;

        return $this;
    }

    /**
     * Get areaResponsable
     *
     * @return string
     */
    public function getAreaResponsable()
    {
        return $this->areaResponsable;
    }

    /**
     * Set tipoDestino
     *
     * @param integer $tipoDestino
     *
     * @return FtRadicacionEntrada
     */
    public function setTipoDestino($tipoDestino)
    {
        $this->tipoDestino = $tipoDestino;

        return $this;
    }

    /**
     * Get tipoDestino
     *
     * @return integer
     */
    public function getTipoDestino()
    {
        return $this->tipoDestino;
    }

    /**
     * Set personaNaturalDest
     *
     * @param string $personaNaturalDest
     *
     * @return FtRadicacionEntrada
     */
    public function setPersonaNaturalDest($personaNaturalDest)
    {
        $this->personaNaturalDest = $personaNaturalDest;

        return $this;
    }

    /**
     * Get personaNaturalDest
     *
     * @return string
     */
    public function getPersonaNaturalDest()
    {
        return $this->personaNaturalDest;
    }

    /**
     * Set tipoMensajeria
     *
     * @param integer $tipoMensajeria
     *
     * @return FtRadicacionEntrada
     */
    public function setTipoMensajeria($tipoMensajeria)
    {
        $this->tipoMensajeria = $tipoMensajeria;

        return $this;
    }

    /**
     * Get tipoMensajeria
     *
     * @return integer
     */
    public function getTipoMensajeria()
    {
        return $this->tipoMensajeria;
    }

    /**
     * Set despachado
     *
     * @param integer $despachado
     *
     * @return FtRadicacionEntrada
     */
    public function setDespachado($despachado)
    {
        $this->despachado = $despachado;

        return $this;
    }

    /**
     * Get despachado
     *
     * @return integer
     */
    public function getDespachado()
    {
        return $this->despachado;
    }

    /**
     * Set empresaTransportado
     *
     * @param string $empresaTransportado
     *
     * @return FtRadicacionEntrada
     */
    public function setEmpresaTransportado($empresaTransportado)
    {
        $this->empresaTransportado = $empresaTransportado;

        return $this;
    }

    /**
     * Get empresaTransportado
     *
     * @return string
     */
    public function getEmpresaTransportado()
    {
        return $this->empresaTransportado;
    }

    /**
     * Set numeroGuia
     *
     * @param string $numeroGuia
     *
     * @return FtRadicacionEntrada
     */
    public function setNumeroGuia($numeroGuia)
    {
        $this->numeroGuia = $numeroGuia;

        return $this;
    }

    /**
     * Get numeroGuia
     *
     * @return string
     */
    public function getNumeroGuia()
    {
        return $this->numeroGuia;
    }

    /**
     * Set tiempoRespuesta
     *
     * @param \DateTime $tiempoRespuesta
     *
     * @return FtRadicacionEntrada
     */
    public function setTiempoRespuesta($tiempoRespuesta)
    {
        $this->tiempoRespuesta = $tiempoRespuesta;

        return $this;
    }

    /**
     * Get tiempoRespuesta
     *
     * @return \DateTime
     */
    public function getTiempoRespuesta()
    {
        return $this->tiempoRespuesta;
    }

    /**
     * Set descripcionGeneral
     *
     * @param string $descripcionGeneral
     *
     * @return FtRadicacionEntrada
     */
    public function setDescripcionGeneral($descripcionGeneral)
    {
        $this->descripcionGeneral = $descripcionGeneral;

        return $this;
    }

    /**
     * Get descripcionGeneral
     *
     * @return string
     */
    public function getDescripcionGeneral()
    {
        return $this->descripcionGeneral;
    }

    /**
     * Set requiereRecogida
     *
     * @param integer $requiereRecogida
     *
     * @return FtRadicacionEntrada
     */
    public function setRequiereRecogida($requiereRecogida)
    {
        $this->requiereRecogida = $requiereRecogida;

        return $this;
    }

    /**
     * Get requiereRecogida
     *
     * @return integer
     */
    public function getRequiereRecogida()
    {
        return $this->requiereRecogida;
    }
}
