<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtFormacionAcademica
 *
 * @ORM\Table(name="ft_formacion_academica", indexes={@ORM\Index(name="i_ft_formacion_academica_doc", columns={"documento_iddocumento"}), @ORM\Index(name="i_formacion_academica_hoja_vida", columns={"ft_hoja_vida"}), @ORM\Index(name="i_formacion_academica_serie_idse", columns={"serie_idserie"})})
 * @ORM\Entity
 */
class FtFormacionAcademica
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_formacion_academica", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftFormacionAcademica;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '888';

    /**
     * @var string
     *
     * @ORM\Column(name="anexos", type="string", length=255, nullable=false)
     */
    private $anexos;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="text", length=65535, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="string", length=255, nullable=false)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="institucion_formacion", type="string", length=255, nullable=false)
     */
    private $institucionFormacion;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo_formacion", type="string", length=255, nullable=false)
     */
    private $tituloFormacion;

    /**
     * @var integer
     *
     * @ORM\Column(name="tipo_formacion", type="integer", nullable=false)
     */
    private $tipoFormacion;

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
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftFormacionAcademica
     *
     * @return integer
     */
    public function getIdftFormacionAcademica()
    {
        return $this->idftFormacionAcademica;
    }

    /**
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtFormacionAcademica
     */
    public function setFtHojaVida($ftHojaVida)
    {
        $this->ftHojaVida = $ftHojaVida;

        return $this;
    }

    /**
     * Get ftHojaVida
     *
     * @return integer
     */
    public function getFtHojaVida()
    {
        return $this->ftHojaVida;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtFormacionAcademica
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
     * @return FtFormacionAcademica
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return FtFormacionAcademica
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return FtFormacionAcademica
     */
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }

    /**
     * Get celular
     *
     * @return string
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return FtFormacionAcademica
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
     * @return FtFormacionAcademica
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
     * Set institucionFormacion
     *
     * @param string $institucionFormacion
     *
     * @return FtFormacionAcademica
     */
    public function setInstitucionFormacion($institucionFormacion)
    {
        $this->institucionFormacion = $institucionFormacion;

        return $this;
    }

    /**
     * Get institucionFormacion
     *
     * @return string
     */
    public function getInstitucionFormacion()
    {
        return $this->institucionFormacion;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtFormacionAcademica
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
     * Set tituloFormacion
     *
     * @param string $tituloFormacion
     *
     * @return FtFormacionAcademica
     */
    public function setTituloFormacion($tituloFormacion)
    {
        $this->tituloFormacion = $tituloFormacion;

        return $this;
    }

    /**
     * Get tituloFormacion
     *
     * @return string
     */
    public function getTituloFormacion()
    {
        return $this->tituloFormacion;
    }

    /**
     * Set tipoFormacion
     *
     * @param integer $tipoFormacion
     *
     * @return FtFormacionAcademica
     */
    public function setTipoFormacion($tipoFormacion)
    {
        $this->tipoFormacion = $tipoFormacion;

        return $this;
    }

    /**
     * Get tipoFormacion
     *
     * @return integer
     */
    public function getTipoFormacion()
    {
        return $this->tipoFormacion;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtFormacionAcademica
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
     * @return FtFormacionAcademica
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
     * @return FtFormacionAcademica
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
     * @return FtFormacionAcademica
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
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtFormacionAcademica
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
