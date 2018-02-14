<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtClinicaOrtodoncia
 *
 * @ORM\Table(name="ft_clinica_ortodoncia", indexes={@ORM\Index(name="i_ft_clinica_ortodoncia_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtClinicaOrtodoncia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_clinica_ortodoncia", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftClinicaOrtodoncia;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '1002';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_usuario", type="string", length=255, nullable=false)
     */
    private $nombreUsuario;

    /**
     * @var string
     *
     * @ORM\Column(name="apellido_usuario", type="string", length=255, nullable=false)
     */
    private $apellidoUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero_doc", type="integer", nullable=false)
     */
    private $numeroDoc;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="depto", type="string", length=255, nullable=false)
     */
    private $depto;

    /**
     * @var integer
     *
     * @ORM\Column(name="edad", type="integer", nullable=true)
     */
    private $edad;

    /**
     * @var integer
     *
     * @ORM\Column(name="sexo", type="integer", nullable=false)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion", type="string", length=255, nullable=false)
     */
    private $ocupacion;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=false)
     */
    private $direccion;

    /**
     * @var string
     *
     * @ORM\Column(name="cel", type="string", length=255, nullable=false)
     */
    private $cel;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_civil", type="integer", nullable=false)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_apellidos_conyugue", type="string", length=255, nullable=true)
     */
    private $nombreApellidosConyugue;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_conyugue", type="string", length=255, nullable=true)
     */
    private $telConyugue;

    /**
     * @var string
     *
     * @ORM\Column(name="nucleo_familiar", type="string", length=255, nullable=true)
     */
    private $nucleoFamiliar;

    /**
     * @var string
     *
     * @ORM\Column(name="grado_escolar", type="string", length=11, nullable=true)
     */
    private $gradoEscolar;

    /**
     * @var string
     *
     * @ORM\Column(name="actividades_tiempo_libro", type="string", length=255, nullable=false)
     */
    private $actividadesTiempoLibro;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_madre", type="string", length=255, nullable=true)
     */
    private $nombreMadre;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_madre", type="string", length=255, nullable=true)
     */
    private $telMadre;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion_madre", type="string", length=255, nullable=true)
     */
    private $ocupacionMadre;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_usuario", type="string", length=255, nullable=false)
     */
    private $telUsuario;

    /**
     * @var integer
     *
     * @ORM\Column(name="tratamiento_previo", type="integer", nullable=false)
     */
    private $tratamientoPrevio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_padre", type="string", length=255, nullable=true)
     */
    private $nombrePadre;

    /**
     * @var string
     *
     * @ORM\Column(name="tel_padre", type="string", length=255, nullable=true)
     */
    private $telPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="ocupacion_padre", type="string", length=255, nullable=true)
     */
    private $ocupacionPadre;

    /**
     * @var string
     *
     * @ORM\Column(name="donde_padre", type="string", length=255, nullable=true)
     */
    private $dondePadre;

    /**
     * @var string
     *
     * @ORM\Column(name="cuanto_tiempo", type="string", length=255, nullable=true)
     */
    private $cuantoTiempo;

    /**
     * @var integer
     *
     * @ORM\Column(name="como_se_entero", type="integer", nullable=false)
     */
    private $comoSeEntero;

    /**
     * @var integer
     *
     * @ORM\Column(name="cedula_ciudadania", type="integer", nullable=false)
     */
    private $cedulaCiudadania;

    /**
     * @var string
     *
     * @ORM\Column(name="donde_madre", type="string", length=255, nullable=true)
     */
    private $dondeMadre;

    /**
     * @var string
     *
     * @ORM\Column(name="donde_usuario", type="string", length=255, nullable=false)
     */
    private $dondeUsuario;

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
     * @ORM\Column(name="actividades_tiempo_libre", type="string", length=255, nullable=true)
     */
    private $actividadesTiempoLibre;

    /**
     * @var integer
     *
     * @ORM\Column(name="tratamientos_previos", type="integer", nullable=false)
     */
    private $tratamientosPrevios;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="creacion_historia", type="date", nullable=true)
     */
    private $creacionHistoria;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
