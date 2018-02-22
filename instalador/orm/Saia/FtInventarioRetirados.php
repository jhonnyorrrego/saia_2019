<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtInventarioRetirados
 *
 * @ORM\Table(name="ft_inventario_retirados", indexes={@ORM\Index(name="i_ft_inventario_retirados_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtInventarioRetirados
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_inventario_retirados", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftInventarioRetirados;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_documento", type="string", length=255, nullable=true)
     */
    private $estadoDocumento;

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
     * @ORM\Column(name="observaciones", type="string", length=255, nullable=true)
     */
    private $observaciones;

    /**
     * @var string
     *
     * @ORM\Column(name="estamento", type="string", length=255, nullable=true)
     */
    private $estamento;

    /**
     * @var string
     *
     * @ORM\Column(name="jubilado_otra_instit", type="string", length=255, nullable=true)
     */
    private $jubiladoOtraInstit;

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
     * @var string
     *
     * @ORM\Column(name="segundo_apellido", type="string", length=255, nullable=false)
     */
    private $segundoApellido;

    /**
     * @var string
     *
     * @ORM\Column(name="primer_apellido", type="string", length=255, nullable=false)
     */
    private $primerApellido;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_retiro", type="date", nullable=false)
     */
    private $fechaRetiro;

    /**
     * @var string
     *
     * @ORM\Column(name="ubicacion", type="string", length=255, nullable=false)
     */
    private $ubicacion;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_caja", type="string", length=255, nullable=false)
     */
    private $numeroCaja;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie;



    /**
     * Get idftInventarioRetirados
     *
     * @return integer
     */
    public function getIdftInventarioRetirados()
    {
        return $this->idftInventarioRetirados;
    }

    /**
     * Set estadoDocumento
     *
     * @param string $estadoDocumento
     *
     * @return FtInventarioRetirados
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

    /**
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * Set estamento
     *
     * @param string $estamento
     *
     * @return FtInventarioRetirados
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
     * Set jubiladoOtraInstit
     *
     * @param string $jubiladoOtraInstit
     *
     * @return FtInventarioRetirados
     */
    public function setJubiladoOtraInstit($jubiladoOtraInstit)
    {
        $this->jubiladoOtraInstit = $jubiladoOtraInstit;

        return $this;
    }

    /**
     * Get jubiladoOtraInstit
     *
     * @return string
     */
    public function getJubiladoOtraInstit()
    {
        return $this->jubiladoOtraInstit;
    }

    /**
     * Set ultimoCargo
     *
     * @param string $ultimoCargo
     *
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @return FtInventarioRetirados
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
     * @param string $segundoApellido
     *
     * @return FtInventarioRetirados
     */
    public function setSegundoApellido($segundoApellido)
    {
        $this->segundoApellido = $segundoApellido;

        return $this;
    }

    /**
     * Get segundoApellido
     *
     * @return string
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
     * @return FtInventarioRetirados
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
     * Set fechaRetiro
     *
     * @param \DateTime $fechaRetiro
     *
     * @return FtInventarioRetirados
     */
    public function setFechaRetiro($fechaRetiro)
    {
        $this->fechaRetiro = $fechaRetiro;

        return $this;
    }

    /**
     * Get fechaRetiro
     *
     * @return \DateTime
     */
    public function getFechaRetiro()
    {
        return $this->fechaRetiro;
    }

    /**
     * Set ubicacion
     *
     * @param string $ubicacion
     *
     * @return FtInventarioRetirados
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
     * Set numeroCaja
     *
     * @param string $numeroCaja
     *
     * @return FtInventarioRetirados
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtInventarioRetirados
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
}
