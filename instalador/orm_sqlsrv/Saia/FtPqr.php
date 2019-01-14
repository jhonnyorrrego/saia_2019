<?php

namespace Saia;

/**
 * FtPqr
 */
class FtPqr
{
    /**
     * @var integer
     */
    private $idftPqr;

    /**
     * @var integer
     */
    private $identificacion;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $email;

    /**
     * @var integer
     */
    private $telefono;

    /**
     * @var integer
     */
    private $solicitud;

    /**
     * @var string
     */
    private $otro;

    /**
     * @var string
     */
    private $nombresApellidos;

    /**
     * @var string
     */
    private $responsable;

    /**
     * @var string
     */
    private $datosPersona;

    /**
     * @var string
     */
    private $idflujo;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $encabezado;

    /**
     * @var integer
     */
    private $documentoIddocumento;

    /**
     * @var integer
     */
    private $dependencia;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $formaEnvio;

    /**
     * @var string
     */
    private $tipo;

    /**
     * @var string
     */
    private $anexoFormato;

    /**
     * @var \DateTime
     */
    private $fechaPqr;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftPqr
     *
     * @return integer
     */
    public function getIdftPqr()
    {
        return $this->idftPqr;
    }

    /**
     * Set identificacion
     *
     * @param integer $identificacion
     *
     * @return FtPqr
     */
    public function setIdentificacion($identificacion)
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    /**
     * Get identificacion
     *
     * @return integer
     */
    public function getIdentificacion()
    {
        return $this->identificacion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return FtPqr
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get direccion
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return FtPqr
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set telefono
     *
     * @param integer $telefono
     *
     * @return FtPqr
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return integer
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set solicitud
     *
     * @param integer $solicitud
     *
     * @return FtPqr
     */
    public function setSolicitud($solicitud)
    {
        $this->solicitud = $solicitud;

        return $this;
    }

    /**
     * Get solicitud
     *
     * @return integer
     */
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * Set otro
     *
     * @param string $otro
     *
     * @return FtPqr
     */
    public function setOtro($otro)
    {
        $this->otro = $otro;

        return $this;
    }

    /**
     * Get otro
     *
     * @return string
     */
    public function getOtro()
    {
        return $this->otro;
    }

    /**
     * Set nombresApellidos
     *
     * @param string $nombresApellidos
     *
     * @return FtPqr
     */
    public function setNombresApellidos($nombresApellidos)
    {
        $this->nombresApellidos = $nombresApellidos;

        return $this;
    }

    /**
     * Get nombresApellidos
     *
     * @return string
     */
    public function getNombresApellidos()
    {
        return $this->nombresApellidos;
    }

    /**
     * Set responsable
     *
     * @param string $responsable
     *
     * @return FtPqr
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
     * Set datosPersona
     *
     * @param string $datosPersona
     *
     * @return FtPqr
     */
    public function setDatosPersona($datosPersona)
    {
        $this->datosPersona = $datosPersona;

        return $this;
    }

    /**
     * Get datosPersona
     *
     * @return string
     */
    public function getDatosPersona()
    {
        return $this->datosPersona;
    }

    /**
     * Set idflujo
     *
     * @param string $idflujo
     *
     * @return FtPqr
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
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return FtPqr
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
     * Set firma
     *
     * @param integer $firma
     *
     * @return FtPqr
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
     * @return FtPqr
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPqr
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
     * @return FtPqr
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
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPqr
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
     * Set formaEnvio
     *
     * @param string $formaEnvio
     *
     * @return FtPqr
     */
    public function setFormaEnvio($formaEnvio)
    {
        $this->formaEnvio = $formaEnvio;

        return $this;
    }

    /**
     * Get formaEnvio
     *
     * @return string
     */
    public function getFormaEnvio()
    {
        return $this->formaEnvio;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FtPqr
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtPqr
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
     * Set fechaPqr
     *
     * @param \DateTime $fechaPqr
     *
     * @return FtPqr
     */
    public function setFechaPqr($fechaPqr)
    {
        $this->fechaPqr = $fechaPqr;

        return $this;
    }

    /**
     * Get fechaPqr
     *
     * @return \DateTime
     */
    public function getFechaPqr()
    {
        return $this->fechaPqr;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtPqr
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

