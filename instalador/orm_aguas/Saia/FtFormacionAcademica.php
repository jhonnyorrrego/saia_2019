<?php

namespace Saia;

/**
 * FtFormacionAcademica
 */
class FtFormacionAcademica
{
    /**
     * @var integer
     */
    private $idftFormacionAcademica;

    /**
     * @var integer
     */
    private $ftHojaVida;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $anexos;

    /**
     * @var string
     */
    private $apellidos;

    /**
     * @var string
     */
    private $celular;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $institucionFormacion;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $tituloFormacion;

    /**
     * @var integer
     */
    private $tipoFormacion;

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
    private $encabezado;

    /**
     * @var integer
     */
    private $firma;

    /**
     * @var integer
     */
    private $estadoDocumento;


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

