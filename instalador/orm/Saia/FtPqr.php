<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPqr
 *
 * @ORM\Table(name="ft_pqr")
 * @ORM\Entity
 */
class FtPqr
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_pqr", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPqr;

    /**
     * @var integer
     *
     * @ORM\Column(name="identificacion", type="integer", nullable=false)
     */
    private $identificacion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefono", type="integer", nullable=false)
     */
    private $telefono;

    /**
     * @var integer
     *
     * @ORM\Column(name="solicitud", type="integer", nullable=false)
     */
    private $solicitud;

    /**
     * @var string
     *
     * @ORM\Column(name="otro", type="string", length=255, nullable=true)
     */
    private $otro;

    /**
     * @var string
     *
     * @ORM\Column(name="nombres_apellidos", type="string", length=255, nullable=false)
     */
    private $nombresApellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="responsable", type="string", length=255, nullable=true)
     */
    private $responsable;

    /**
     * @var string
     *
     * @ORM\Column(name="datos_persona", type="string", length=255, nullable=false)
     */
    private $datosPersona;

    /**
     * @var string
     *
     * @ORM\Column(name="idflujo", type="string", length=255, nullable=true)
     */
    private $idflujo = '2';

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=false)
     */
    private $descripcion;

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
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '852';

    /**
     * @var string
     *
     * @ORM\Column(name="forma_envio", type="string", length=255, nullable=false)
     */
    private $formaEnvio;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_pqr", type="datetime", nullable=false)
     */
    private $fechaPqr;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
