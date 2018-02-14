<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtHojaVida
 *
 * @ORM\Table(name="ft_hoja_vida", indexes={@ORM\Index(name="i_ft_hoja_vida_doc", columns={"documento_iddocumento"})})
 * @ORM\Entity
 */
class FtHojaVida
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_hoja_vida", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftHojaVida;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '887';

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="text", length=65535, nullable=true)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="apellidos", type="text", length=65535, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="documento_identidad", type="string", length=255, nullable=false)
     */
    private $documentoIdentidad;

    /**
     * @var integer
     *
     * @ORM\Column(name="lugar_documento", type="integer", nullable=false)
     */
    private $lugarDocumento = '883';

    /**
     * @var string
     *
     * @ORM\Column(name="direccion", type="text", length=65535, nullable=false)
     */
    private $direccion;

    /**
     * @var integer
     *
     * @ORM\Column(name="telefonos", type="integer", nullable=false)
     */
    private $telefonos;

    /**
     * @var string
     *
     * @ORM\Column(name="celular", type="text", length=65535, nullable=true)
     */
    private $celular;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="lugar_nacimiento", type="integer", nullable=false)
     */
    private $lugarNacimiento = '883';

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_nacimiento", type="date", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="eps", type="text", length=65535, nullable=false)
     */
    private $eps;

    /**
     * @var string
     *
     * @ORM\Column(name="cuenta_ahorro", type="string", length=50, nullable=true)
     */
    private $cuentaAhorro;

    /**
     * @var string
     *
     * @ORM\Column(name="banco", type="text", length=65535, nullable=false)
     */
    private $banco;

    /**
     * @var string
     *
     * @ORM\Column(name="blusa", type="string", length=255, nullable=true)
     */
    private $blusa;

    /**
     * @var string
     *
     * @ORM\Column(name="pantalon", type="string", length=255, nullable=true)
     */
    private $pantalon;

    /**
     * @var string
     *
     * @ORM\Column(name="calzado", type="string", length=5, nullable=false)
     */
    private $calzado;

    /**
     * @var string
     *
     * @ORM\Column(name="cesantias", type="string", length=255, nullable=true)
     */
    private $cesantias;

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
     * @ORM\Column(name="pensiones", type="string", length=255, nullable=true)
     */
    private $pensiones;

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftHojaVida
     *
     * @return integer
     */
    public function getIdftHojaVida()
    {
        return $this->idftHojaVida;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtHojaVida
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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return FtHojaVida
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
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return FtHojaVida
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
     * Set documentoIdentidad
     *
     * @param string $documentoIdentidad
     *
     * @return FtHojaVida
     */
    public function setDocumentoIdentidad($documentoIdentidad)
    {
        $this->documentoIdentidad = $documentoIdentidad;

        return $this;
    }

    /**
     * Get documentoIdentidad
     *
     * @return string
     */
    public function getDocumentoIdentidad()
    {
        return $this->documentoIdentidad;
    }

    /**
     * Set lugarDocumento
     *
     * @param integer $lugarDocumento
     *
     * @return FtHojaVida
     */
    public function setLugarDocumento($lugarDocumento)
    {
        $this->lugarDocumento = $lugarDocumento;

        return $this;
    }

    /**
     * Get lugarDocumento
     *
     * @return integer
     */
    public function getLugarDocumento()
    {
        return $this->lugarDocumento;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     *
     * @return FtHojaVida
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
     * Set telefonos
     *
     * @param integer $telefonos
     *
     * @return FtHojaVida
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;

        return $this;
    }

    /**
     * Get telefonos
     *
     * @return integer
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * Set celular
     *
     * @param string $celular
     *
     * @return FtHojaVida
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
     * Set email
     *
     * @param string $email
     *
     * @return FtHojaVida
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
     * Set lugarNacimiento
     *
     * @param integer $lugarNacimiento
     *
     * @return FtHojaVida
     */
    public function setLugarNacimiento($lugarNacimiento)
    {
        $this->lugarNacimiento = $lugarNacimiento;

        return $this;
    }

    /**
     * Get lugarNacimiento
     *
     * @return integer
     */
    public function getLugarNacimiento()
    {
        return $this->lugarNacimiento;
    }

    /**
     * Set fechaNacimiento
     *
     * @param \DateTime $fechaNacimiento
     *
     * @return FtHojaVida
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
     * Set eps
     *
     * @param string $eps
     *
     * @return FtHojaVida
     */
    public function setEps($eps)
    {
        $this->eps = $eps;

        return $this;
    }

    /**
     * Get eps
     *
     * @return string
     */
    public function getEps()
    {
        return $this->eps;
    }

    /**
     * Set cuentaAhorro
     *
     * @param string $cuentaAhorro
     *
     * @return FtHojaVida
     */
    public function setCuentaAhorro($cuentaAhorro)
    {
        $this->cuentaAhorro = $cuentaAhorro;

        return $this;
    }

    /**
     * Get cuentaAhorro
     *
     * @return string
     */
    public function getCuentaAhorro()
    {
        return $this->cuentaAhorro;
    }

    /**
     * Set banco
     *
     * @param string $banco
     *
     * @return FtHojaVida
     */
    public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }

    /**
     * Get banco
     *
     * @return string
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * Set blusa
     *
     * @param string $blusa
     *
     * @return FtHojaVida
     */
    public function setBlusa($blusa)
    {
        $this->blusa = $blusa;

        return $this;
    }

    /**
     * Get blusa
     *
     * @return string
     */
    public function getBlusa()
    {
        return $this->blusa;
    }

    /**
     * Set pantalon
     *
     * @param string $pantalon
     *
     * @return FtHojaVida
     */
    public function setPantalon($pantalon)
    {
        $this->pantalon = $pantalon;

        return $this;
    }

    /**
     * Get pantalon
     *
     * @return string
     */
    public function getPantalon()
    {
        return $this->pantalon;
    }

    /**
     * Set calzado
     *
     * @param string $calzado
     *
     * @return FtHojaVida
     */
    public function setCalzado($calzado)
    {
        $this->calzado = $calzado;

        return $this;
    }

    /**
     * Get calzado
     *
     * @return string
     */
    public function getCalzado()
    {
        return $this->calzado;
    }

    /**
     * Set cesantias
     *
     * @param string $cesantias
     *
     * @return FtHojaVida
     */
    public function setCesantias($cesantias)
    {
        $this->cesantias = $cesantias;

        return $this;
    }

    /**
     * Get cesantias
     *
     * @return string
     */
    public function getCesantias()
    {
        return $this->cesantias;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtHojaVida
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
     * @return FtHojaVida
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
     * @return FtHojaVida
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
     * @return FtHojaVida
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
     * Set pensiones
     *
     * @param string $pensiones
     *
     * @return FtHojaVida
     */
    public function setPensiones($pensiones)
    {
        $this->pensiones = $pensiones;

        return $this;
    }

    /**
     * Get pensiones
     *
     * @return string
     */
    public function getPensiones()
    {
        return $this->pensiones;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtHojaVida
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
