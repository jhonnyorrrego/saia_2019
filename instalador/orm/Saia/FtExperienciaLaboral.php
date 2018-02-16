<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtExperienciaLaboral
 *
 * @ORM\Table(name="ft_experiencia_laboral", indexes={@ORM\Index(name="i_ft_experiencia_laboral_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtExperienciaLaboral
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_experiencia_laboral", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $idftExperienciaLaboral;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '891';

    /**
     * @var string
     *
     * @ORM\Column(name="adjuntar_documento", type="string", length=255, nullable=true)
     */
    private $adjuntarDocumento;

    /**
     * @var string
     *
     * @ORM\Column(name="cargo_realizado", type="string", length=255, nullable=false)
     */
    private $cargoRealizado;

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="string", length=255, nullable=true)
     */
    private $direccion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_ingreso", type="date", nullable=false)
     */
    private $fechaIngreso;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_retiro", type="date", nullable=true)
     */
    private $fechaRetiro;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_hoja_vida", type="integer", nullable=false)
     */
    private $ftHojaVida;

    /**
     * @var string
     *
     * @ORM\Column(name="funciones_realizadas", type="text", length=65535, nullable=true)
     */
    private $funcionesRealizadas;

    /**
     * @var string
     *
     * @ORM\Column(name="jefe_inmediato", type="string", length=255, nullable=true)
     */
    private $jefeInmediato;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_retiro", type="text", length=65535, nullable=true)
     */
    private $motivoRetiro;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="salario_final", type="string", length=255, nullable=true)
     */
    private $salarioFinal;

    /**
     * @var string
     *
     * @ORM\Column(name="salario_inicial", type="string", length=100, nullable=true)
     */
    private $salarioInicial;

    /**
     * @var string
     *
     * @ORM\Column(name="telefonos", type="string", length=255, nullable=true)
     */
    private $telefonos;

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
     * @ORM\Column(name="nombre_empresa", type="string", length=255, nullable=false)
     */
    private $nombreEmpresa;

    /**
     * @var integer
     *
     * @ORM\Column(name="verificado", type="integer", nullable=true)
     */
    private $verificado;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



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
