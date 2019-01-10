<?php

namespace Saia;

/**
 * FtClinicaOrtodoncia
 */
class FtClinicaOrtodoncia
{
    /**
     * @var integer
     */
    private $idftClinicaOrtodoncia;

    /**
     * @var integer
     */
    private $serieIdserie;

    /**
     * @var string
     */
    private $nombreUsuario;

    /**
     * @var string
     */
    private $apellidoUsuario;

    /**
     * @var integer
     */
    private $numeroDoc;

    /**
     * @var \DateTime
     */
    private $fechaNacimiento;

    /**
     * @var string
     */
    private $depto;

    /**
     * @var integer
     */
    private $edad;

    /**
     * @var integer
     */
    private $sexo;

    /**
     * @var string
     */
    private $ocupacion;

    /**
     * @var string
     */
    private $direccion;

    /**
     * @var string
     */
    private $cel;

    /**
     * @var integer
     */
    private $estadoCivil;

    /**
     * @var string
     */
    private $nombreApellidosConyugue;

    /**
     * @var string
     */
    private $telConyugue;

    /**
     * @var string
     */
    private $nucleoFamiliar;

    /**
     * @var string
     */
    private $gradoEscolar;

    /**
     * @var string
     */
    private $actividadesTiempoLibro;

    /**
     * @var string
     */
    private $nombreMadre;

    /**
     * @var string
     */
    private $telMadre;

    /**
     * @var string
     */
    private $ocupacionMadre;

    /**
     * @var string
     */
    private $telUsuario;

    /**
     * @var integer
     */
    private $tratamientoPrevio;

    /**
     * @var string
     */
    private $nombrePadre;

    /**
     * @var string
     */
    private $telPadre;

    /**
     * @var string
     */
    private $ocupacionPadre;

    /**
     * @var string
     */
    private $dondePadre;

    /**
     * @var string
     */
    private $cuantoTiempo;

    /**
     * @var integer
     */
    private $comoSeEntero;

    /**
     * @var integer
     */
    private $cedulaCiudadania;

    /**
     * @var string
     */
    private $dondeMadre;

    /**
     * @var string
     */
    private $dondeUsuario;

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
    private $actividadesTiempoLibre;

    /**
     * @var integer
     */
    private $tratamientosPrevios;

    /**
     * @var \DateTime
     */
    private $creacionHistoria;

    /**
     * @var integer
     */
    private $estadoDocumento;


    /**
     * Get idftClinicaOrtodoncia
     *
     * @return integer
     */
    public function getIdftClinicaOrtodoncia()
    {
        return $this->idftClinicaOrtodoncia;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtClinicaOrtodoncia
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
     * Set nombreUsuario
     *
     * @param string $nombreUsuario
     *
     * @return FtClinicaOrtodoncia
     */
    public function setNombreUsuario($nombreUsuario)
    {
        $this->nombreUsuario = $nombreUsuario;

        return $this;
    }

    /**
     * Get nombreUsuario
     *
     * @return string
     */
    public function getNombreUsuario()
    {
        return $this->nombreUsuario;
    }

    /**
     * Set apellidoUsuario
     *
     * @param string $apellidoUsuario
     *
     * @return FtClinicaOrtodoncia
     */
    public function setApellidoUsuario($apellidoUsuario)
    {
        $this->apellidoUsuario = $apellidoUsuario;

        return $this;
    }

    /**
     * Get apellidoUsuario
     *
     * @return string
     */
    public function getApellidoUsuario()
    {
        return $this->apellidoUsuario;
    }

    /**
     * Set numeroDoc
     *
     * @param integer $numeroDoc
     *
     * @return FtClinicaOrtodoncia
     */
    public function setNumeroDoc($numeroDoc)
    {
        $this->numeroDoc = $numeroDoc;

        return $this;
    }

    /**
     * Get numeroDoc
     *
     * @return integer
     */
    public function getNumeroDoc()
    {
        return $this->numeroDoc;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return FtClinicaOrtodoncia
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fechaNacimiento
     *
     * @return \DateTime
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * Set depto
     *
     * @param string $depto
     *
     * @return FtClinicaOrtodoncia
     */
    public function setDepto($depto)
    {
        $this->depto = $depto;

        return $this;
    }

    /**
     * Get depto
     *
     * @return string
     */
    public function getDepto()
    {
        return $this->depto;
    }

    /**
     * Set edad
     *
     * @param integer $edad
     *
     * @return FtClinicaOrtodoncia
     */
    public function setEdad($edad)
    {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad
     *
     * @return integer
     */
    public function getEdad()
    {
        return $this->edad;
    }

    /**
     * Set sexo
     *
     * @param integer $sexo
     *
     * @return FtClinicaOrtodoncia
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return integer
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set ocupacion
     *
     * @param string $ocupacion
     *
     * @return FtClinicaOrtodoncia
     */
    public function setOcupacion($ocupacion)
    {
        $this->ocupacion = $ocupacion;

        return $this;
    }

    /**
     * Get ocupacion
     *
     * @return string
     */
    public function getOcupacion()
    {
        return $this->ocupacion;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return FtClinicaOrtodoncia
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
     * Set cel
     *
     * @param string $cel
     *
     * @return FtClinicaOrtodoncia
     */
    public function setCel($cel)
    {
        $this->cel = $cel;

        return $this;
    }

    /**
     * Get cel
     *
     * @return string
     */
    public function getCel()
    {
        return $this->cel;
    }

    /**
     * Set estadoCivil
     *
     * @param integer $estadoCivil
     *
     * @return FtClinicaOrtodoncia
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return integer
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set nombreApellidosConyugue
     *
     * @param string $nombreApellidosConyugue
     *
     * @return FtClinicaOrtodoncia
     */
    public function setNombreApellidosConyugue($nombreApellidosConyugue)
    {
        $this->nombreApellidosConyugue = $nombreApellidosConyugue;

        return $this;
    }

    /**
     * Get nombreApellidosConyugue
     *
     * @return string
     */
    public function getNombreApellidosConyugue()
    {
        return $this->nombreApellidosConyugue;
    }

    /**
     * Set telConyugue
     *
     * @param string $telConyugue
     *
     * @return FtClinicaOrtodoncia
     */
    public function setTelConyugue($telConyugue)
    {
        $this->telConyugue = $telConyugue;

        return $this;
    }

    /**
     * Get telConyugue
     *
     * @return string
     */
    public function getTelConyugue()
    {
        return $this->telConyugue;
    }

    /**
     * Set nucleoFamiliar
     *
     * @param string $nucleoFamiliar
     *
     * @return FtClinicaOrtodoncia
     */
    public function setNucleoFamiliar($nucleoFamiliar)
    {
        $this->nucleoFamiliar = $nucleoFamiliar;

        return $this;
    }

    /**
     * Get nucleoFamiliar
     *
     * @return string
     */
    public function getNucleoFamiliar()
    {
        return $this->nucleoFamiliar;
    }

    /**
     * Set gradoEscolar
     *
     * @param string $gradoEscolar
     *
     * @return FtClinicaOrtodoncia
     */
    public function setGradoEscolar($gradoEscolar)
    {
        $this->gradoEscolar = $gradoEscolar;

        return $this;
    }

    /**
     * Get gradoEscolar
     *
     * @return string
     */
    public function getGradoEscolar()
    {
        return $this->gradoEscolar;
    }

    /**
     * Set actividadesTiempoLibro
     *
     * @param string $actividadesTiempoLibro
     *
     * @return FtClinicaOrtodoncia
     */
    public function setActividadesTiempoLibro($actividadesTiempoLibro)
    {
        $this->actividadesTiempoLibro = $actividadesTiempoLibro;

        return $this;
    }

    /**
     * Get actividadesTiempoLibro
     *
     * @return string
     */
    public function getActividadesTiempoLibro()
    {
        return $this->actividadesTiempoLibro;
    }

    /**
     * Set nombreMadre
     *
     * @param string $nombreMadre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setNombreMadre($nombreMadre)
    {
        $this->nombreMadre = $nombreMadre;

        return $this;
    }

    /**
     * Get nombreMadre
     *
     * @return string
     */
    public function getNombreMadre()
    {
        return $this->nombreMadre;
    }

    /**
     * Set telMadre
     *
     * @param string $telMadre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setTelMadre($telMadre)
    {
        $this->telMadre = $telMadre;

        return $this;
    }

    /**
     * Get telMadre
     *
     * @return string
     */
    public function getTelMadre()
    {
        return $this->telMadre;
    }

    /**
     * Set ocupacionMadre
     *
     * @param string $ocupacionMadre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setOcupacionMadre($ocupacionMadre)
    {
        $this->ocupacionMadre = $ocupacionMadre;

        return $this;
    }

    /**
     * Get ocupacionMadre
     *
     * @return string
     */
    public function getOcupacionMadre()
    {
        return $this->ocupacionMadre;
    }

    /**
     * Set telUsuario
     *
     * @param string $telUsuario
     *
     * @return FtClinicaOrtodoncia
     */
    public function setTelUsuario($telUsuario)
    {
        $this->telUsuario = $telUsuario;

        return $this;
    }

    /**
     * Get telUsuario
     *
     * @return string
     */
    public function getTelUsuario()
    {
        return $this->telUsuario;
    }

    /**
     * Set tratamientoPrevio
     *
     * @param integer $tratamientoPrevio
     *
     * @return FtClinicaOrtodoncia
     */
    public function setTratamientoPrevio($tratamientoPrevio)
    {
        $this->tratamientoPrevio = $tratamientoPrevio;

        return $this;
    }

    /**
     * Get tratamientoPrevio
     *
     * @return integer
     */
    public function getTratamientoPrevio()
    {
        return $this->tratamientoPrevio;
    }

    /**
     * Set nombrePadre
     *
     * @param string $nombrePadre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setNombrePadre($nombrePadre)
    {
        $this->nombrePadre = $nombrePadre;

        return $this;
    }

    /**
     * Get nombrePadre
     *
     * @return string
     */
    public function getNombrePadre()
    {
        return $this->nombrePadre;
    }

    /**
     * Set telPadre
     *
     * @param string $telPadre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setTelPadre($telPadre)
    {
        $this->telPadre = $telPadre;

        return $this;
    }

    /**
     * Get telPadre
     *
     * @return string
     */
    public function getTelPadre()
    {
        return $this->telPadre;
    }

    /**
     * Set ocupacionPadre
     *
     * @param string $ocupacionPadre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setOcupacionPadre($ocupacionPadre)
    {
        $this->ocupacionPadre = $ocupacionPadre;

        return $this;
    }

    /**
     * Get ocupacionPadre
     *
     * @return string
     */
    public function getOcupacionPadre()
    {
        return $this->ocupacionPadre;
    }

    /**
     * Set dondePadre
     *
     * @param string $dondePadre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setDondePadre($dondePadre)
    {
        $this->dondePadre = $dondePadre;

        return $this;
    }

    /**
     * Get dondePadre
     *
     * @return string
     */
    public function getDondePadre()
    {
        return $this->dondePadre;
    }

    /**
     * Set cuantoTiempo
     *
     * @param string $cuantoTiempo
     *
     * @return FtClinicaOrtodoncia
     */
    public function setCuantoTiempo($cuantoTiempo)
    {
        $this->cuantoTiempo = $cuantoTiempo;

        return $this;
    }

    /**
     * Get cuantoTiempo
     *
     * @return string
     */
    public function getCuantoTiempo()
    {
        return $this->cuantoTiempo;
    }

    /**
     * Set comoSeEntero
     *
     * @param integer $comoSeEntero
     *
     * @return FtClinicaOrtodoncia
     */
    public function setComoSeEntero($comoSeEntero)
    {
        $this->comoSeEntero = $comoSeEntero;

        return $this;
    }

    /**
     * Get comoSeEntero
     *
     * @return integer
     */
    public function getComoSeEntero()
    {
        return $this->comoSeEntero;
    }

    /**
     * Set cedulaCiudadania
     *
     * @param integer $cedulaCiudadania
     *
     * @return FtClinicaOrtodoncia
     */
    public function setCedulaCiudadania($cedulaCiudadania)
    {
        $this->cedulaCiudadania = $cedulaCiudadania;

        return $this;
    }

    /**
     * Get cedulaCiudadania
     *
     * @return integer
     */
    public function getCedulaCiudadania()
    {
        return $this->cedulaCiudadania;
    }

    /**
     * Set dondeMadre
     *
     * @param string $dondeMadre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setDondeMadre($dondeMadre)
    {
        $this->dondeMadre = $dondeMadre;

        return $this;
    }

    /**
     * Get dondeMadre
     *
     * @return string
     */
    public function getDondeMadre()
    {
        return $this->dondeMadre;
    }

    /**
     * Set dondeUsuario
     *
     * @param string $dondeUsuario
     *
     * @return FtClinicaOrtodoncia
     */
    public function setDondeUsuario($dondeUsuario)
    {
        $this->dondeUsuario = $dondeUsuario;

        return $this;
    }

    /**
     * Get dondeUsuario
     *
     * @return string
     */
    public function getDondeUsuario()
    {
        return $this->dondeUsuario;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtClinicaOrtodoncia
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
     * @return FtClinicaOrtodoncia
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
     * @return FtClinicaOrtodoncia
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
     * @return FtClinicaOrtodoncia
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
     * Set actividadesTiempoLibre
     *
     * @param string $actividadesTiempoLibre
     *
     * @return FtClinicaOrtodoncia
     */
    public function setActividadesTiempoLibre($actividadesTiempoLibre)
    {
        $this->actividadesTiempoLibre = $actividadesTiempoLibre;

        return $this;
    }

    /**
     * Get actividadesTiempoLibre
     *
     * @return string
     */
    public function getActividadesTiempoLibre()
    {
        return $this->actividadesTiempoLibre;
    }

    /**
     * Set tratamientosPrevios
     *
     * @param integer $tratamientosPrevios
     *
     * @return FtClinicaOrtodoncia
     */
    public function setTratamientosPrevios($tratamientosPrevios)
    {
        $this->tratamientosPrevios = $tratamientosPrevios;

        return $this;
    }

    /**
     * Get tratamientosPrevios
     *
     * @return integer
     */
    public function getTratamientosPrevios()
    {
        return $this->tratamientosPrevios;
    }

    /**
     * Set creacionHistoria
     *
     * @param \DateTime $creacionHistoria
     *
     * @return FtClinicaOrtodoncia
     */
    public function setCreacionHistoria($creacionHistoria)
    {
        $this->creacionHistoria = $creacionHistoria;

        return $this;
    }

    /**
     * Get creacionHistoria
     *
     * @return \DateTime
     */
    public function getCreacionHistoria()
    {
        return $this->creacionHistoria;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtClinicaOrtodoncia
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

