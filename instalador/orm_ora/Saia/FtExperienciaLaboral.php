<?php

namespace Saia;

/**
 * FtExperienciaLaboral
 */
class FtExperienciaLaboral
{
    /**
     * @var integer
     */
    private $idftExperienciaLaboral;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $adjuntarDocumento;

    /**
     * @var string
     */
    private $cargoRealizado;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var \DateTime
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     */
    private $fechaRetiro;

    /**
     * @var integer
     */
    private $ftHojaVida;

    /**
     * @var string
     */
    private $funcionesRealizadas;

    /**
     * @var string
     */
    private $jefeInmediato;

    /**
     * @var string
     */
    private $motivoRetiro;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $salarioFinal;

    /**
     * @var string
     */
    private $salarioInicial;

    /**
     * @var string
     */
    private $telefonos;

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
     * @var string
     */
    private $nombreEmpresa;

    /**
     * @var integer
     */
    private $verificado;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftExperienciaLaboral
     *
     * @return integer
     */
    public function getIdftExperienciaLaboral()
    {
        return $this->idftExperienciaLaboral;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtExperienciaLaboral
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
     * Set adjuntarDocumento
     *
     * @param string $adjuntarDocumento
     *
     * @return FtExperienciaLaboral
     */
    public function setAdjuntarDocumento($adjuntarDocumento)
    {
        $this->adjuntarDocumento = $adjuntarDocumento;

        return $this;
    }

    /**
     * Get adjuntarDocumento
     *
     * @return string
     */
    public function getAdjuntarDocumento()
    {
        return $this->adjuntarDocumento;
    }

    /**
     * Set cargoRealizado
     *
     * @param string $cargoRealizado
     *
     * @return FtExperienciaLaboral
     */
    public function setCargoRealizado($cargoRealizado)
    {
        $this->cargoRealizado = $cargoRealizado;

        return $this;
    }

    /**
     * Get cargoRealizado
     *
     * @return string
     */
    public function getCargoRealizado()
    {
        return $this->cargoRealizado;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return FtExperienciaLaboral
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
     * Set fechaIngreso
     *
     * @param \DateTime $fechaIngreso
     *
     * @return FtExperienciaLaboral
     */
    public function setFechaIngreso($fechaIngreso)
    {
        $this->fechaIngreso = $fechaIngreso;

        return $this;
    }

    /**
     * Get fechaIngreso
     *
     * @return \DateTime
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * Set fechaRetiro
     *
     * @param \DateTime $fechaRetiro
     *
     * @return FtExperienciaLaboral
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
     * Set ftHojaVida
     *
     * @param integer $ftHojaVida
     *
     * @return FtExperienciaLaboral
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
     * Set funcionesRealizadas
     *
     * @param string $funcionesRealizadas
     *
     * @return FtExperienciaLaboral
     */
    public function setFuncionesRealizadas($funcionesRealizadas)
    {
        $this->funcionesRealizadas = $funcionesRealizadas;

        return $this;
    }

    /**
     * Get funcionesRealizadas
     *
     * @return string
     */
    public function getFuncionesRealizadas()
    {
        return $this->funcionesRealizadas;
    }

    /**
     * Set jefeInmediato
     *
     * @param string $jefeInmediato
     *
     * @return FtExperienciaLaboral
     */
    public function setJefeInmediato($jefeInmediato)
    {
        $this->jefeInmediato = $jefeInmediato;

        return $this;
    }

    /**
     * Get jefeInmediato
     *
     * @return string
     */
    public function getJefeInmediato()
    {
        return $this->jefeInmediato;
    }

    /**
     * Set motivoRetiro
     *
     * @param string $motivoRetiro
     *
     * @return FtExperienciaLaboral
     */
    public function setMotivoRetiro($motivoRetiro)
    {
        $this->motivoRetiro = $motivoRetiro;

        return $this;
    }

    /**
     * Get motivoRetiro
     *
     * @return string
     */
    public function getMotivoRetiro()
    {
        return $this->motivoRetiro;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtExperienciaLaboral
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
     * Set salarioFinal
     *
     * @param string $salarioFinal
     *
     * @return FtExperienciaLaboral
     */
    public function setSalarioFinal($salarioFinal)
    {
        $this->salarioFinal = $salarioFinal;

        return $this;
    }

    /**
     * Get salarioFinal
     *
     * @return string
     */
    public function getSalarioFinal()
    {
        return $this->salarioFinal;
    }

    /**
     * Set salarioInicial
     *
     * @param string $salarioInicial
     *
     * @return FtExperienciaLaboral
     */
    public function setSalarioInicial($salarioInicial)
    {
        $this->salarioInicial = $salarioInicial;

        return $this;
    }

    /**
     * Get salarioInicial
     *
     * @return string
     */
    public function getSalarioInicial()
    {
        return $this->salarioInicial;
    }

    /**
     * Set telefonos
     *
     * @param string $telefonos
     *
     * @return FtExperienciaLaboral
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;

        return $this;
    }

    /**
     * Get telefonos
     *
     * @return string
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtExperienciaLaboral
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
     * @return FtExperienciaLaboral
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
     * @return FtExperienciaLaboral
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
     * @return FtExperienciaLaboral
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
     * Set nombreEmpresa
     *
     * @param string $nombreEmpresa
     *
     * @return FtExperienciaLaboral
     */
    public function setNombreEmpresa($nombreEmpresa)
    {
        $this->nombreEmpresa = $nombreEmpresa;

        return $this;
    }

    /**
     * Get nombreEmpresa
     *
     * @return string
     */
    public function getNombreEmpresa()
    {
        return $this->nombreEmpresa;
    }

    /**
     * Set verificado
     *
     * @param integer $verificado
     *
     * @return FtExperienciaLaboral
     */
    public function setVerificado($verificado)
    {
        $this->verificado = $verificado;

        return $this;
    }

    /**
     * Get verificado
     *
     * @return integer
     */
    public function getVerificado()
    {
        return $this->verificado;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtExperienciaLaboral
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

