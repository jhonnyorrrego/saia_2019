<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtPqrsf
 *
 * @ORM\Table(name="ft_pqrsf", indexes={@ORM\Index(name="i_pqrsf_documento_", columns={"documento_iddocumento"}), @ORM\Index(name="i_pqrsf_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtPqrsf
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_pqrsf", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftPqrsf;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1032';

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=true)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="comentarios", type="text", length=65535, nullable=false)
     */
    private $comentarios;

    /**
     * @var string
     *
     * @ORM\Column(name="documento", type="string", length=255, nullable=true)
     */
    private $documento;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_reporte", type="integer", nullable=true)
     */
    private $estadoReporte = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_verificacion", type="integer", nullable=true)
     */
    private $estadoVerificacion = '1';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_reporte", type="datetime", nullable=true)
     */
    private $fechaReporte;

    /**
     * @var integer
     *
     * @ORM\Column(name="funcionario_reporte", type="integer", nullable=true)
     */
    private $funcionarioReporte;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="rol_institucion", type="integer", nullable=false)
     */
    private $rolInstitucion;

    /**
     * @var string
     *
     * @ORM\Column(name="telefono", type="string", length=255, nullable=true)
     */
    private $telefono;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255, nullable=false)
     */
    private $tipo;

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
     * @ORM\Column(name="numero_radicado", type="string", length=255, nullable=true)
     */
    private $numeroRadicado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="datetime", nullable=true)
     */
    private $fecha;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_radicado", type="integer", nullable=true)
     */
    private $estadoRadicado = '1';



    /**
     * Get idftPqrsf
     *
     * @return integer
     */
    public function getIdftPqrsf()
    {
        return $this->idftPqrsf;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtPqrsf
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
     * Set anexos
     *
     * @param string $anexos
     *
     * @return FtPqrsf
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
     * Set comentarios
     *
     * @param string $comentarios
     *
     * @return FtPqrsf
     */
    public function setComentarios($comentarios)
    {
        $this->comentarios = $comentarios;

        return $this;
    }

    /**
     * Get comentarios
     *
     * @return string
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * Set documento
     *
     * @param string $documento
     *
     * @return FtPqrsf
     */
    public function setDocumento($documento)
    {
        $this->documento = $documento;

        return $this;
    }

    /**
     * Get documento
     *
     * @return string
     */
    public function getDocumento()
    {
        return $this->documento;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return FtPqrsf
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
     * Set estadoReporte
     *
     * @param integer $estadoReporte
     *
     * @return FtPqrsf
     */
    public function setEstadoReporte($estadoReporte)
    {
        $this->estadoReporte = $estadoReporte;

        return $this;
    }

    /**
     * Get estadoReporte
     *
     * @return integer
     */
    public function getEstadoReporte()
    {
        return $this->estadoReporte;
    }

    /**
     * Set estadoVerificacion
     *
     * @param integer $estadoVerificacion
     *
     * @return FtPqrsf
     */
    public function setEstadoVerificacion($estadoVerificacion)
    {
        $this->estadoVerificacion = $estadoVerificacion;

        return $this;
    }

    /**
     * Get estadoVerificacion
     *
     * @return integer
     */
    public function getEstadoVerificacion()
    {
        return $this->estadoVerificacion;
    }

    /**
     * Set fechaReporte
     *
     * @param \DateTime $fechaReporte
     *
     * @return FtPqrsf
     */
    public function setFechaReporte($fechaReporte)
    {
        $this->fechaReporte = $fechaReporte;

        return $this;
    }

    /**
     * Get fechaReporte
     *
     * @return \DateTime
     */
    public function getFechaReporte()
    {
        return $this->fechaReporte;
    }

    /**
     * Set funcionarioReporte
     *
     * @param integer $funcionarioReporte
     *
     * @return FtPqrsf
     */
    public function setFuncionarioReporte($funcionarioReporte)
    {
        $this->funcionarioReporte = $funcionarioReporte;

        return $this;
    }

    /**
     * Get funcionarioReporte
     *
     * @return integer
     */
    public function getFuncionarioReporte()
    {
        return $this->funcionarioReporte;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtPqrsf
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
     * Set rolInstitucion
     *
     * @param integer $rolInstitucion
     *
     * @return FtPqrsf
     */
    public function setRolInstitucion($rolInstitucion)
    {
        $this->rolInstitucion = $rolInstitucion;

        return $this;
    }

    /**
     * Get rolInstitucion
     *
     * @return integer
     */
    public function getRolInstitucion()
    {
        return $this->rolInstitucion;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     *
     * @return FtPqrsf
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return FtPqrsf
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
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtPqrsf
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
     * @return FtPqrsf
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
     * @return FtPqrsf
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
     * @return FtPqrsf
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
     * Set numeroRadicado
     *
     * @param string $numeroRadicado
     *
     * @return FtPqrsf
     */
    public function setNumeroRadicado($numeroRadicado)
    {
        $this->numeroRadicado = $numeroRadicado;

        return $this;
    }

    /**
     * Get numeroRadicado
     *
     * @return string
     */
    public function getNumeroRadicado()
    {
        return $this->numeroRadicado;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtPqrsf
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtPqrsf
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
     * Set estadoRadicado
     *
     * @param integer $estadoRadicado
     *
     * @return FtPqrsf
     */
    public function setEstadoRadicado($estadoRadicado)
    {
        $this->estadoRadicado = $estadoRadicado;

        return $this;
    }

    /**
     * Get estadoRadicado
     *
     * @return integer
     */
    public function getEstadoRadicado()
    {
        return $this->estadoRadicado;
    }
}
