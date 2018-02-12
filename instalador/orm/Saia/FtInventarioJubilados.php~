<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtInventarioJubilados
 *
 * @ORM\Table(name="ft_inventario_jubilados", indexes={@ORM\Index(name="i_ft_inventario_jubilados_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_inventario_jubilados_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtInventarioJubilados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_inventario_jubilados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftInventarioJubilados;

    /**
     * @var integer
     *
     * @ORM\Column(name="firma", type="integer", nullable=false)
     */
    private $firma = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="encabezado", type="integer", nullable=false)
     */
    private $encabezado = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="dependencia", type="integer", nullable=false)
     */
    private $dependencia;

    /**
     * @var integer
     *
     * @ORM\Column(name="documento_iddocumento", type="integer", nullable=false)
     */
    private $documentoIddocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="observaciones", type="text", length=65535, nullable=true)
     */
    private $observaciones;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_reconocimiento", type="date", nullable=true)
     */
    private $fechaReconocimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="cedula_sustitucion", type="string", length=255, nullable=true)
     */
    private $cedulaSustitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="sustitucion_pensiona", type="string", length=255, nullable=true)
     */
    private $sustitucionPensiona;

    /**
     * @var string
     *
     * @ORM\Column(name="demandado", type="string", length=255, nullable=true)
     */
    private $demandado;

    /**
     * @var string
     *
     * @ORM\Column(name="estamento", type="string", length=255, nullable=true)
     */
    private $estamento;

    /**
     * @var string
     *
     * @ORM\Column(name="ultimo_cargo", type="string", length=255, nullable=true)
     */
    private $ultimoCargo;

    /**
     * @var integer
     *
     * @ORM\Column(name="folios", type="integer", nullable=false)
     */
    private $folios;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_extrema_final", type="date", nullable=false)
     */
    private $fechaExtremaFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_extrema_inicia", type="date", nullable=false)
     */
    private $fechaExtremaInicia;

    /**
     * @var string
     *
     * @ORM\Column(name="num_identificacion", type="string", length=255, nullable=false)
     */
    private $numIdentificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_completo", type="string", length=255, nullable=false)
     */
    private $nombreCompleto;

    /**
     * @var integer
     *
     * @ORM\Column(name="segundo_apellido", type="integer", nullable=true)
     */
    private $segundoApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=255, nullable=false)
     */
    private $primerApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="emanada_de", type="string", length=255, nullable=true)
     */
    private $emanadaDe;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_resolucion", type="string", length=255, nullable=true)
     */
    private $numeroResolucion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_jubilacion", type="date", nullable=false)
     */
    private $fechaJubilacion;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_caja", type="string", length=255, nullable=false)
     */
    private $numeroCaja;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="string", length=255, nullable=false)
     */
    private $ubicacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1293';

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;



    /**
     * Get idftInventarioJubilados
     *
     * @return integer
     */
    public function getIdftInventarioJubilados()
    {
        return $this->idftInventarioJubilados;
    }

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtInventarioJubilados
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
     * Set encabezado
     *
     * @param integer $encabezado
     *
     * @return FtInventarioJubilados
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
     * Set dependencia
     *
     * @param integer $dependencia
     *
     * @return FtInventarioJubilados
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtInventarioJubilados
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
     * Set observaciones
     *
     * @param string $observaciones
     *
     * @return FtInventarioJubilados
     */
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }

    /**
     * Get observaciones
     *
     * @return string
     */
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set fechaReconocimiento
     *
     * @param \DateTime $fechaReconocimiento
     *
     * @return FtInventarioJubilados
     */
    public function setFechaReconocimiento($fechaReconocimiento)
    {
        $this->fechaReconocimiento = $fechaReconocimiento;

        return $this;
    }

    /**
     * Get fechaReconocimiento
     *
     * @return \DateTime
     */
    public function getFechaReconocimiento()
    {
        return $this->fechaReconocimiento;
    }

    /**
     * Set cedulaSustitucion
     *
     * @param string $cedulaSustitucion
     *
     * @return FtInventarioJubilados
     */
    public function setCedulaSustitucion($cedulaSustitucion)
    {
        $this->cedulaSustitucion = $cedulaSustitucion;

        return $this;
    }

    /**
     * Get cedulaSustitucion
     *
     * @return string
     */
    public function getCedulaSustitucion()
    {
        return $this->cedulaSustitucion;
    }

    /**
     * Set sustitucionPensiona
     *
     * @param string $sustitucionPensiona
     *
     * @return FtInventarioJubilados
     */
    public function setSustitucionPensiona($sustitucionPensiona)
    {
        $this->sustitucionPensiona = $sustitucionPensiona;

        return $this;
    }

    /**
     * Get sustitucionPensiona
     *
     * @return string
     */
    public function getSustitucionPensiona()
    {
        return $this->sustitucionPensiona;
    }

    /**
     * Set demandado
     *
     * @param string $demandado
     *
     * @return FtInventarioJubilados
     */
    public function setDemandado($demandado)
    {
        $this->demandado = $demandado;

        return $this;
    }

    /**
     * Get demandado
     *
     * @return string
     */
    public function getDemandado()
    {
        return $this->demandado;
    }

    /**
     * Set estamento
     *
     * @param string $estamento
     *
     * @return FtInventarioJubilados
     */
    public function setEstamento($estamento)
    {
        $this->estamento = $estamento;

        return $this;
    }

    /**
     * Get estamento
     *
     * @return string
     */
    public function getEstamento()
    {
        return $this->estamento;
    }

    /**
     * Set ultimoCargo
     *
     * @param string $ultimoCargo
     *
     * @return FtInventarioJubilados
     */
    public function setUltimoCargo($ultimoCargo)
    {
        $this->ultimoCargo = $ultimoCargo;

        return $this;
    }

    /**
     * Get ultimoCargo
     *
     * @return string
     */
    public function getUltimoCargo()
    {
        return $this->ultimoCargo;
    }

    /**
     * Set folios
     *
     * @param integer $folios
     *
     * @return FtInventarioJubilados
     */
    public function setFolios($folios)
    {
        $this->folios = $folios;

        return $this;
    }

    /**
     * Get folios
     *
     * @return integer
     */
    public function getFolios()
    {
        return $this->folios;
    }

    /**
     * Set fechaExtremaFinal
     *
     * @param \DateTime $fechaExtremaFinal
     *
     * @return FtInventarioJubilados
     */
    public function setFechaExtremaFinal($fechaExtremaFinal)
    {
        $this->fechaExtremaFinal = $fechaExtremaFinal;

        return $this;
    }

    /**
     * Get fechaExtremaFinal
     *
     * @return \DateTime
     */
    public function getFechaExtremaFinal()
    {
        return $this->fechaExtremaFinal;
    }

    /**
     * Set fechaExtremaInicia
     *
     * @param \DateTime $fechaExtremaInicia
     *
     * @return FtInventarioJubilados
     */
    public function setFechaExtremaInicia($fechaExtremaInicia)
    {
        $this->fechaExtremaInicia = $fechaExtremaInicia;

        return $this;
    }

    /**
     * Get fechaExtremaInicia
     *
     * @return \DateTime
     */
    public function getFechaExtremaInicia()
    {
        return $this->fechaExtremaInicia;
    }

    /**
     * Set numIdentificacion
     *
     * @param string $numIdentificacion
     *
     * @return FtInventarioJubilados
     */
    public function setNumIdentificacion($numIdentificacion)
    {
        $this->numIdentificacion = $numIdentificacion;

        return $this;
    }

    /**
     * Get numIdentificacion
     *
     * @return string
     */
    public function getNumIdentificacion()
    {
        return $this->numIdentificacion;
    }

    /**
     * Set nombreCompleto
     *
     * @param string $nombreCompleto
     *
     * @return FtInventarioJubilados
     */
    public function setNombreCompleto($nombreCompleto)
    {
        $this->nombreCompleto = $nombreCompleto;

        return $this;
    }

    /**
     * Get nombreCompleto
     *
     * @return string
     */
    public function getNombreCompleto()
    {
        return $this->nombreCompleto;
    }

    /**
     * Set segundoApellido
     *
     * @param integer $segundoApellido
     *
     * @return FtInventarioJubilados
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return integer
     */
    public function getSegundoApellido()
    {
        return $this->segundoApellido;
    }

    /**
     * Set primerApellido
     *
     * @param string $primerApellido
     *
     * @return FtInventarioJubilados
     */
    public function setPrimerApellido($primerApellido)
    {
        $this->primerApellido = $primerApellido;

        return $this;
    }

    /**
     * Get primerApellido
     *
     * @return string
     */
    public function getPrimerApellido()
    {
        return $this->primerApellido;
    }

    /**
     * Set emanadaDe
     *
     * @param string $emanadaDe
     *
     * @return FtInventarioJubilados
     */
    public function setEmanadaDe($emanadaDe)
    {
        $this->emanadaDe = $emanadaDe;

        return $this;
    }

    /**
     * Get emanadaDe
     *
     * @return string
     */
    public function getEmanadaDe()
    {
        return $this->emanadaDe;
    }

    /**
     * Set numeroResolucion
     *
     * @param string $numeroResolucion
     *
     * @return FtInventarioJubilados
     */
    public function setNumeroResolucion($numeroResolucion)
    {
        $this->numeroResolucion = $numeroResolucion;

        return $this;
    }

    /**
     * Get numeroResolucion
     *
     * @return string
     */
    public function getNumeroResolucion()
    {
        return $this->numeroResolucion;
    }

    /**
     * Set fechaJubilacion
     *
     * @param \DateTime $fechaJubilacion
     *
     * @return FtInventarioJubilados
     */
    public function setFechaJubilacion($fechaJubilacion)
    {
        $this->fechaJubilacion = $fechaJubilacion;

        return $this;
    }

    /**
     * Get fechaJubilacion
     *
     * @return \DateTime
     */
    public function getFechaJubilacion()
    {
        return $this->fechaJubilacion;
    }

    /**
     * Set numeroCaja
     *
     * @param string $numeroCaja
     *
     * @return FtInventarioJubilados
     */
    public function setNumeroCaja($numeroCaja)
    {
        $this->numeroCaja = $numeroCaja;

        return $this;
    }

    /**
     * Get numeroCaja
     *
     * @return string
     */
    public function getNumeroCaja()
    {
        return $this->numeroCaja;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return FtInventarioJubilados
     */
    public function setUbicacion($ubicacion)
    {
        $this->ubicacion = $ubicacion;

        return $this;
    }

    /**
     * Get ubicacion
     *
     * @return string
     */
    public function getUbicacion()
    {
        return $this->ubicacion;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtInventarioJubilados
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
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtInventarioJubilados
     */
    public function setEstadoDocumento($estadoDocumento)
    {
        $this->estadoDocumento = $estadoDocumento;

        return $this;
    }

    /**
     * Get estadoDocumento
     *
     * @return string
     */
    public function getEstadoDocumento()
    {
        return $this->estadoDocumento;
    }
}
