<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtConfirNegociVehiculo
 *
 * @ORM\Table(name="ft_confir_negoci_vehiculo", indexes={@ORM\Index(name="i_ft_confir_negoci_vehiculo_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_confir_negoci_vehic_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtConfirNegociVehiculo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_confir_negoci_vehiculo", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftConfirNegociVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '946';

    /**
     * @var string
     *
     * @ORM\Column(name="placa_asignada_vehiculo", type="string", length=6, nullable=false)
     */
    private $placaAsignadaVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_matricula", type="string", length=255, nullable=true)
     */
    private $numeroMatricula;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_matricula", type="integer", nullable=true)
     */
    private $valorMatricula;

    /**
     * @var string
     *
     * @ORM\Column(name="campo_seguros", type="string", length=255, nullable=true)
     */
    private $campoSeguros;

    /**
     * @var integer
     *
     * @ORM\Column(name="valor_seguros", type="integer", nullable=true)
     */
    private $valorSeguros;

    /**
     * @var string
     *
     * @ORM\Column(name="datos_cliente", type="string", length=255, nullable=false)
     */
    private $datosCliente;

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
     * @ORM\Column(name="observaciones_negocia", type="string", length=255, nullable=true)
     */
    private $observacionesNegocia;

    /**
     * @var string
     *
     * @ORM\Column(name="datos_vehiculo", type="string", length=255, nullable=true)
     */
    private $datosVehiculo;

    /**
     * @var string
     *
     * @ORM\Column(name="ver_info_vehiculo", type="string", length=255, nullable=true)
     */
    private $verInfoVehiculo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_confirmacion", type="date", nullable=true)
     */
    private $fechaConfirmacion;

    /**
     * @var string
     *
     * @ORM\Column(name="accesorios_vehiculo", type="string", length=255, nullable=true)
     */
    private $accesoriosVehiculo;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftConfirNegociVehiculo
     *
     * @return integer
     */
    public function getIdftConfirNegociVehiculo()
    {
        return $this->idftConfirNegociVehiculo;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtConfirNegociVehiculo
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
     * Set placaAsignadaVehiculo
     *
     * @param string $placaAsignadaVehiculo
     *
     * @return FtConfirNegociVehiculo
     */
    public function setPlacaAsignadaVehiculo($placaAsignadaVehiculo)
    {
        $this->placaAsignadaVehiculo = $placaAsignadaVehiculo;

        return $this;
    }

    /**
     * Get placaAsignadaVehiculo
     *
     * @return string
     */
    public function getPlacaAsignadaVehiculo()
    {
        return $this->placaAsignadaVehiculo;
    }

    /**
     * Set numeroMatricula
     *
     * @param string $numeroMatricula
     *
     * @return FtConfirNegociVehiculo
     */
    public function setNumeroMatricula($numeroMatricula)
    {
        $this->numeroMatricula = $numeroMatricula;

        return $this;
    }

    /**
     * Get numeroMatricula
     *
     * @return string
     */
    public function getNumeroMatricula()
    {
        return $this->numeroMatricula;
    }

    /**
     * Set valorMatricula
     *
     * @param integer $valorMatricula
     *
     * @return FtConfirNegociVehiculo
     */
    public function setValorMatricula($valorMatricula)
    {
        $this->valorMatricula = $valorMatricula;

        return $this;
    }

    /**
     * Get valorMatricula
     *
     * @return integer
     */
    public function getValorMatricula()
    {
        return $this->valorMatricula;
    }

    /**
     * Set campoSeguros
     *
     * @param string $campoSeguros
     *
     * @return FtConfirNegociVehiculo
     */
    public function setCampoSeguros($campoSeguros)
    {
        $this->campoSeguros = $campoSeguros;

        return $this;
    }

    /**
     * Get campoSeguros
     *
     * @return string
     */
    public function getCampoSeguros()
    {
        return $this->campoSeguros;
    }

    /**
     * Set valorSeguros
     *
     * @param integer $valorSeguros
     *
     * @return FtConfirNegociVehiculo
     */
    public function setValorSeguros($valorSeguros)
    {
        $this->valorSeguros = $valorSeguros;

        return $this;
    }

    /**
     * Get valorSeguros
     *
     * @return integer
     */
    public function getValorSeguros()
    {
        return $this->valorSeguros;
    }

    /**
     * Set datosCliente
     *
     * @param string $datosCliente
     *
     * @return FtConfirNegociVehiculo
     */
    public function setDatosCliente($datosCliente)
    {
        $this->datosCliente = $datosCliente;

        return $this;
    }

    /**
     * Get datosCliente
     *
     * @return string
     */
    public function getDatosCliente()
    {
        return $this->datosCliente;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtConfirNegociVehiculo
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
     * @return FtConfirNegociVehiculo
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
     * @return FtConfirNegociVehiculo
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
     * @return FtConfirNegociVehiculo
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
     * Set observacionesNegocia
     *
     * @param string $observacionesNegocia
     *
     * @return FtConfirNegociVehiculo
     */
    public function setObservacionesNegocia($observacionesNegocia)
    {
        $this->observacionesNegocia = $observacionesNegocia;

        return $this;
    }

    /**
     * Get observacionesNegocia
     *
     * @return string
     */
    public function getObservacionesNegocia()
    {
        return $this->observacionesNegocia;
    }

    /**
     * Set datosVehiculo
     *
     * @param string $datosVehiculo
     *
     * @return FtConfirNegociVehiculo
     */
    public function setDatosVehiculo($datosVehiculo)
    {
        $this->datosVehiculo = $datosVehiculo;

        return $this;
    }

    /**
     * Get datosVehiculo
     *
     * @return string
     */
    public function getDatosVehiculo()
    {
        return $this->datosVehiculo;
    }

    /**
     * Set verInfoVehiculo
     *
     * @param string $verInfoVehiculo
     *
     * @return FtConfirNegociVehiculo
     */
    public function setVerInfoVehiculo($verInfoVehiculo)
    {
        $this->verInfoVehiculo = $verInfoVehiculo;

        return $this;
    }

    /**
     * Get verInfoVehiculo
     *
     * @return string
     */
    public function getVerInfoVehiculo()
    {
        return $this->verInfoVehiculo;
    }

    /**
     * Set fechaConfirmacion
     *
     * @param \DateTime $fechaConfirmacion
     *
     * @return FtConfirNegociVehiculo
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
     * Set accesoriosVehiculo
     *
     * @param string $accesoriosVehiculo
     *
     * @return FtConfirNegociVehiculo
     */
    public function setAccesoriosVehiculo($accesoriosVehiculo)
    {
        $this->accesoriosVehiculo = $accesoriosVehiculo;

        return $this;
    }

    /**
     * Get accesoriosVehiculo
     *
     * @return string
     */
    public function getAccesoriosVehiculo()
    {
        return $this->accesoriosVehiculo;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtConfirNegociVehiculo
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
