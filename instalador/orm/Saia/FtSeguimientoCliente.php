<?php

namespace Saia;

use Doctrine\ORM\Mapping as ORM;

/**
 * FtSeguimientoCliente
 *
 * @ORM\Table(name="ft_seguimiento_cliente")
 * @ORM\Entity
 */
class FtSeguimientoCliente
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idft_seguimiento_cliente", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idftSeguimientoCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="anexo_formato", type="string", length=255, nullable=true)
     */
    private $anexoFormato;

    /**
     * @var integer
     *
     * @ORM\Column(name="ft_registro_cliente", type="integer", nullable=false)
     */
    private $ftRegistroCliente;

    /**
     * @var integer
     *
     * @ORM\Column(name="serie_idserie", type="integer", nullable=false)
     */
    private $serieIdserie = '923';

    /**
     * @var string
     *
     * @ORM\Column(name="empresa_asociada", type="string", length=255, nullable=false)
     */
    private $empresaAsociada;

    /**
     * @var string
     *
     * @ORM\Column(name="envio_propuesta", type="decimal", precision=10, scale=0, nullable=true)
     */
    private $envioPropuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="estado_cliente", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $estadoCliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_seguimiento", type="date", nullable=false)
     */
    private $fechaSeguimiento;

    /**
     * @var integer
     *
     * @ORM\Column(name="forma_contacto", type="integer", nullable=false)
     */
    private $formaContacto;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_producto_servicio", type="string", length=255, nullable=false)
     */
    private $nombreProductoServicio;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre_propuesta", type="string", length=255, nullable=false)
     */
    private $nombrePropuesta;

    /**
     * @var string
     *
     * @ORM\Column(name="resultado_seguimiento", type="string", length=255, nullable=false)
     */
    private $resultadoSeguimiento;

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
     * @ORM\Column(name="estado_propuesta", type="integer", nullable=false)
     */
    private $estadoPropuesta = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="estado_documento", type="integer", nullable=false)
     */
    private $estadoDocumento = '1';



    /**
     * Get idftSeguimientoCliente
     *
     * @return integer
     */
    public function getIdftSeguimientoCliente()
    {
        return $this->idftSeguimientoCliente;
    }

    /**
     * Set anexoFormato
     *
     * @param string $anexoFormato
     *
     * @return FtSeguimientoCliente
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
     * Set ftRegistroCliente
     *
     * @param integer $ftRegistroCliente
     *
     * @return FtSeguimientoCliente
     */
    public function setFtRegistroCliente($ftRegistroCliente)
    {
        $this->ftRegistroCliente = $ftRegistroCliente;

        return $this;
    }

    /**
     * Get ftRegistroCliente
     *
     * @return integer
     */
    public function getFtRegistroCliente()
    {
        return $this->ftRegistroCliente;
    }

    /**
     * Set serieIdserie
     *
     * @param integer $serieIdserie
     *
     * @return FtSeguimientoCliente
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
     * Set empresaAsociada
     *
     * @param string $empresaAsociada
     *
     * @return FtSeguimientoCliente
     */
    public function setEmpresaAsociada($empresaAsociada)
    {
        $this->empresaAsociada = $empresaAsociada;

        return $this;
    }

    /**
     * Get empresaAsociada
     *
     * @return string
     */
    public function getEmpresaAsociada()
    {
        return $this->empresaAsociada;
    }

    /**
     * Set envioPropuesta
     *
     * @param string $envioPropuesta
     *
     * @return FtSeguimientoCliente
     */
    public function setEnvioPropuesta($envioPropuesta)
    {
        $this->envioPropuesta = $envioPropuesta;

        return $this;
    }

    /**
     * Get envioPropuesta
     *
     * @return string
     */
    public function getEnvioPropuesta()
    {
        return $this->envioPropuesta;
    }

    /**
     * Set estadoCliente
     *
     * @param string $estadoCliente
     *
     * @return FtSeguimientoCliente
     */
    public function setEstadoCliente($estadoCliente)
    {
        $this->estadoCliente = $estadoCliente;

        return $this;
    }

    /**
     * Get estadoCliente
     *
     * @return string
     */
    public function getEstadoCliente()
    {
        return $this->estadoCliente;
    }

    /**
     * Set fecha
     *
     * @param \DateTime $fecha
     *
     * @return FtSeguimientoCliente
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
     * Set fechaSeguimiento
     *
     * @param \DateTime $fechaSeguimiento
     *
     * @return FtSeguimientoCliente
     */
    public function setFechaSeguimiento($fechaSeguimiento)
    {
        $this->fechaSeguimiento = $fechaSeguimiento;

        return $this;
    }

    /**
     * Get fechaSeguimiento
     *
     * @return \DateTime
     */
    public function getFechaSeguimiento()
    {
        return $this->fechaSeguimiento;
    }

    /**
     * Set formaContacto
     *
     * @param integer $formaContacto
     *
     * @return FtSeguimientoCliente
     */
    public function setFormaContacto($formaContacto)
    {
        $this->formaContacto = $formaContacto;

        return $this;
    }

    /**
     * Get formaContacto
     *
     * @return integer
     */
    public function getFormaContacto()
    {
        return $this->formaContacto;
    }

    /**
     * Set nombreProductoServicio
     *
     * @param string $nombreProductoServicio
     *
     * @return FtSeguimientoCliente
     */
    public function setNombreProductoServicio($nombreProductoServicio)
    {
        $this->nombreProductoServicio = $nombreProductoServicio;

        return $this;
    }

    /**
     * Get nombreProductoServicio
     *
     * @return string
     */
    public function getNombreProductoServicio()
    {
        return $this->nombreProductoServicio;
    }

    /**
     * Set nombrePropuesta
     *
     * @param string $nombrePropuesta
     *
     * @return FtSeguimientoCliente
     */
    public function setNombrePropuesta($nombrePropuesta)
    {
        $this->nombrePropuesta = $nombrePropuesta;

        return $this;
    }

    /**
     * Get nombrePropuesta
     *
     * @return string
     */
    public function getNombrePropuesta()
    {
        return $this->nombrePropuesta;
    }

    /**
     * Set resultadoSeguimiento
     *
     * @param string $resultadoSeguimiento
     *
     * @return FtSeguimientoCliente
     */
    public function setResultadoSeguimiento($resultadoSeguimiento)
    {
        $this->resultadoSeguimiento = $resultadoSeguimiento;

        return $this;
    }

    /**
     * Get resultadoSeguimiento
     *
     * @return string
     */
    public function getResultadoSeguimiento()
    {
        return $this->resultadoSeguimiento;
    }

    /**
     * Set documentoIddocumento
     *
     * @param integer $documentoIddocumento
     *
     * @return FtSeguimientoCliente
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
     * @return FtSeguimientoCliente
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
     * @return FtSeguimientoCliente
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
     * @return FtSeguimientoCliente
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
     * Set estadoPropuesta
     *
     * @param integer $estadoPropuesta
     *
     * @return FtSeguimientoCliente
     */
    public function setEstadoPropuesta($estadoPropuesta)
    {
        $this->estadoPropuesta = $estadoPropuesta;

        return $this;
    }

    /**
     * Get estadoPropuesta
     *
     * @return integer
     */
    public function getEstadoPropuesta()
    {
        return $this->estadoPropuesta;
    }

    /**
     * Set estadoDocumento
     *
     * @param integer $estadoDocumento
     *
     * @return FtSeguimientoCliente
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
